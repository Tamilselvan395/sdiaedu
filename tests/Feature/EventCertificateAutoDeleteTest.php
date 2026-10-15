<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventCertificate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EventCertificateAutoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_expired_certificates_in_completed_events_are_automatically_deleted_with_pdf_files(): void
    {
        Storage::fake('public');

        // Completed event that ended 45 days ago
        $completedEvent = Event::create([
            'title' => 'State Championship 2026',
            'slug' => 'state-championship-2026',
            'short_description' => 'Completed championship.',
            'mode' => 'In-Person',
            'start_date' => now()->subDays(46),
            'end_date' => now()->subDays(45),
            'is_active' => true,
        ]);

        $filePath = 'events/certificates/test-participant-cert.pdf';
        Storage::disk('public')->put($filePath, '%PDF-1.4 mock certificate data');

        $cert = EventCertificate::create([
            'event_id' => $completedEvent->id,
            'participant_name' => 'Siddharth V',
            'registration_number' => 'ST-2026-001',
            'certificate_file' => $filePath,
            'is_published' => true,
        ]);

        // Manually backdate created_at to 40 days ago
        EventCertificate::where('id', $cert->id)->update([
            'created_at' => now()->subDays(40),
            'updated_at' => now()->subDays(40),
        ]);

        $this->assertTrue(Storage::disk('public')->exists($filePath));
        $this->assertDatabaseHas('event_certificates', ['id' => $cert->id]);

        // Run cleanup artisan command
        $this->artisan('events:clean-expired-certificates')
            ->expectsOutputToContain('SUCCESS: Permanently removed 1 expired certificate(s)')
            ->assertSuccessful();

        // Database record and storage file must both be deleted
        $this->assertDatabaseMissing('event_certificates', ['id' => $cert->id]);
        $this->assertFalse(Storage::disk('public')->exists($filePath));
    }

    public function test_recent_certificates_under_30_days_are_preserved(): void
    {
        Storage::fake('public');

        // Event concluded only 10 days ago
        $recentEvent = Event::create([
            'title' => 'Recent Workshop 2026',
            'slug' => 'recent-workshop-2026',
            'short_description' => 'Recent workshop.',
            'mode' => 'In-Person',
            'start_date' => now()->subDays(11),
            'end_date' => now()->subDays(10),
            'is_active' => true,
        ]);

        $filePath = 'events/certificates/recent-cert.pdf';
        Storage::disk('public')->put($filePath, '%PDF-1.4 recent mock certificate');

        $cert = EventCertificate::create([
            'event_id' => $recentEvent->id,
            'participant_name' => 'Ananya Sharma',
            'certificate_file' => $filePath,
            'is_published' => true,
        ]);

        EventCertificate::where('id', $cert->id)->update([
            'created_at' => now()->subDays(10),
        ]);

        $this->artisan('events:clean-expired-certificates')
            ->expectsOutputToContain('No expired certificates found older than 30 days')
            ->assertSuccessful();

        // Record and file must remain intact
        $this->assertDatabaseHas('event_certificates', ['id' => $cert->id]);
        $this->assertTrue(Storage::disk('public')->exists($filePath));
    }

    public function test_upcoming_event_certificates_are_never_deleted(): void
    {
        Storage::fake('public');

        $upcomingEvent = Event::create([
            'title' => 'Future Olympiad 2027',
            'slug' => 'future-olympiad-2027',
            'short_description' => 'Future olympiad.',
            'mode' => 'In-Person',
            'start_date' => now()->addDays(20),
            'end_date' => now()->addDays(21),
            'is_active' => true,
        ]);

        $filePath = 'events/certificates/future-cert.pdf';
        Storage::disk('public')->put($filePath, '%PDF-1.4 future mock certificate');

        $cert = EventCertificate::create([
            'event_id' => $upcomingEvent->id,
            'participant_name' => 'Rohan Sen',
            'certificate_file' => $filePath,
            'is_published' => true,
        ]);

        EventCertificate::where('id', $cert->id)->update([
            'created_at' => now()->subDays(45), // Old upload date, but future event
        ]);

        $this->artisan('events:clean-expired-certificates')
            ->expectsOutputToContain('No expired certificates found older than 30 days')
            ->assertSuccessful();

        $this->assertDatabaseHas('event_certificates', ['id' => $cert->id]);
        $this->assertTrue(Storage::disk('public')->exists($filePath));
    }

    public function test_dry_run_option_previews_deletion_without_touching_records_or_files(): void
    {
        Storage::fake('public');

        $oldEvent = Event::create([
            'title' => 'Old Expo 2025',
            'slug' => 'old-expo-2025',
            'short_description' => 'Old expo.',
            'mode' => 'In-Person',
            'start_date' => now()->subDays(60),
            'end_date' => now()->subDays(58),
            'is_active' => true,
        ]);

        $filePath = 'events/certificates/dry-run-cert.pdf';
        Storage::disk('public')->put($filePath, '%PDF-1.4 test certificate');

        $cert = EventCertificate::create([
            'event_id' => $oldEvent->id,
            'participant_name' => 'Kavitha R',
            'certificate_file' => $filePath,
            'is_published' => true,
        ]);

        EventCertificate::where('id', $cert->id)->update([
            'created_at' => now()->subDays(50),
        ]);

        $this->artisan('events:clean-expired-certificates', ['--dry-run' => true])
            ->expectsOutputToContain('Running in DRY-RUN mode')
            ->expectsOutputToContain('DRY RUN: Found 1 expired certificate(s) that would be deleted')
            ->assertSuccessful();

        // Files and records must still be present
        $this->assertDatabaseHas('event_certificates', ['id' => $cert->id]);
        $this->assertTrue(Storage::disk('public')->exists($filePath));
    }

    public function test_deleting_event_certificate_removes_physical_pdf_file_from_storage(): void
    {
        Storage::fake('public');

        $event = Event::create([
            'title' => 'Sample Championship',
            'slug' => 'sample-championship',
            'short_description' => 'Description.',
            'mode' => 'In-Person',
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(6),
            'is_active' => true,
        ]);

        $filePath = 'events/certificates/individual-delete.pdf';
        Storage::disk('public')->put($filePath, '%PDF-1.4 file content');

        $cert = EventCertificate::create([
            'event_id' => $event->id,
            'participant_name' => 'Direct Delete Student',
            'certificate_file' => $filePath,
            'is_published' => true,
        ]);

        $this->assertTrue(Storage::disk('public')->exists($filePath));

        // Delete model
        $cert->delete();

        // Storage file must be deleted automatically
        $this->assertFalse(Storage::disk('public')->exists($filePath));
    }

    public function test_deleting_event_cascades_and_removes_all_its_certificate_pdfs_from_storage(): void
    {
        Storage::fake('public');

        $event = Event::create([
            'title' => 'Event To Be Deleted',
            'slug' => 'event-to-be-deleted',
            'short_description' => 'Description.',
            'mode' => 'In-Person',
            'start_date' => now()->addDays(2),
            'end_date' => now()->addDays(3),
            'is_active' => true,
        ]);

        $file1 = 'events/certificates/cert-1.pdf';
        $file2 = 'events/certificates/cert-2.pdf';
        Storage::disk('public')->put($file1, '%PDF content 1');
        Storage::disk('public')->put($file2, '%PDF content 2');

        EventCertificate::create([
            'event_id' => $event->id,
            'participant_name' => 'Student 1',
            'certificate_file' => $file1,
        ]);

        EventCertificate::create([
            'event_id' => $event->id,
            'participant_name' => 'Student 2',
            'certificate_file' => $file2,
        ]);

        $this->assertTrue(Storage::disk('public')->exists($file1));
        $this->assertTrue(Storage::disk('public')->exists($file2));

        $event->delete();

        // Both certificates and their physical files must be deleted
        $this->assertFalse(Storage::disk('public')->exists($file1));
        $this->assertFalse(Storage::disk('public')->exists($file2));
        $this->assertDatabaseEmpty('event_certificates');
    }

    public function test_model_prune_command_deletes_expired_event_certificates(): void
    {
        Storage::fake('public');

        $oldEvent = Event::create([
            'title' => 'Old Prunable Event',
            'slug' => 'old-prunable-event',
            'short_description' => 'Old event.',
            'mode' => 'In-Person',
            'start_date' => now()->subDays(60),
            'end_date' => now()->subDays(59),
            'is_active' => true,
        ]);

        $filePath = 'events/certificates/prune-test.pdf';
        Storage::disk('public')->put($filePath, '%PDF prunable');

        $cert = EventCertificate::create([
            'event_id' => $oldEvent->id,
            'participant_name' => 'Prune Me',
            'certificate_file' => $filePath,
        ]);

        EventCertificate::where('id', $cert->id)->update([
            'created_at' => now()->subDays(40),
        ]);

        $this->artisan('model:prune', ['--model' => [EventCertificate::class]])
            ->assertSuccessful();

        $this->assertDatabaseMissing('event_certificates', ['id' => $cert->id]);
        $this->assertFalse(Storage::disk('public')->exists($filePath));
    }
}
