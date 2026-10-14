<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCertificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EventController extends Controller
{
    /**
     * Display a listing of upcoming and past academy events.
     */
    public function index(Request $request): View
    {
        $upcomingEvents = Event::upcoming()->get();
        $pastEvents = Event::past()->take(6)->get();

        return view('events.index', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
            'metaTitle' => 'Upcoming Academy Events & Workshops | Sri Deekshaa International Academy',
            'metaDescription' => 'Explore upcoming student championships, robotics hackathons, teacher training seminars, and skill competitions at Sri Deekshaa International Academy.',
        ]);
    }

    /**
     * Display the specified event.
     */
    public function show(string $slug): View
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $certificates = $event->certificates()
            ->where('is_published', true)
            ->orderBy('participant_name')
            ->get();

        $otherEvents = Event::upcoming()
            ->where('id', '!=', $event->id)
            ->take(3)
            ->get();

        return view('events.show', [
            'event' => $event,
            'certificates' => $certificates,
            'otherEvents' => $otherEvents,
            'metaTitle' => ($event->meta_title ?: $event->title).' | Sri Deekshaa International Academy',
            'metaDescription' => $event->meta_description ?: ($event->short_description ?: 'Join us for '.$event->title.' at Sri Deekshaa International Academy.'),
            'canonicalUrl' => route('events.show', $event->slug),
        ]);
    }

    /**
     * Download or view participant certificate PDF for this event.
     */
    public function downloadCertificate(string $slug, int|string $certificateId): StreamedResponse|BinaryFileResponse|RedirectResponse
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $certificate = EventCertificate::where('id', $certificateId)
            ->where('event_id', $event->id)
            ->where('is_published', true)
            ->firstOrFail();

        $relativeFile = $certificate->certificate_file;

        // If stored on cloud or external URL, redirect directly
        if (str_starts_with($relativeFile, 'http://') || str_starts_with($relativeFile, 'https://')) {
            return redirect()->away($relativeFile);
        }

        $cleanParticipantName = Str::slug($certificate->participant_name);
        $cleanEventTitle = Str::slug($event->title);
        $extension = pathinfo($relativeFile, PATHINFO_EXTENSION) ?: 'pdf';
        $downloadName = "Sri-Deekshaa-{$cleanEventTitle}-{$cleanParticipantName}.{$extension}";

        if (Storage::disk('public')->exists($relativeFile)) {
            return Storage::disk('public')->download($relativeFile, $downloadName);
        }

        if (file_exists(public_path('storage/'.$relativeFile))) {
            return response()->download(public_path('storage/'.$relativeFile), $downloadName);
        }

        abort(404, 'Certificate file not found on server.');
    }
}
