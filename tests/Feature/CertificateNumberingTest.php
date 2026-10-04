<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Student;
use Database\Seeders\CourseCategorySeeder;
use Database\Seeders\CourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificateNumberingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CourseCategorySeeder::class);
        $this->seed(CourseSeeder::class);
    }

    public function test_course_short_codes_are_loaded_from_database(): void
    {
        $abacus = Course::where('slug', 'abacus')->first();
        $vedic = Course::where('slug', 'vedic-maths')->first();
        $phonics = Course::where('slug', 'phonics')->first();

        $this->assertEquals('ABA', $abacus->short_code);
        $this->assertEquals('VM', $vedic->short_code);
        $this->assertEquals('PHO', $phonics->short_code);

        $this->assertEquals('ABA', Certificate::getCourseShortCode($abacus));
        $this->assertEquals('VM', Certificate::getCourseShortCode($vedic));
        $this->assertEquals('PHO', Certificate::getCourseShortCode($phonics));
    }

    public function test_custom_admin_short_code_overrides_default(): void
    {
        $abacus = Course::where('slug', 'abacus')->first();
        $abacus->update(['short_code' => 'ABACUSTOM']);

        $this->assertEquals('ABACUSTOM', Certificate::getCourseShortCode($abacus));
    }

    public function test_continuous_sequential_certificate_numbering_across_courses(): void
    {
        $student = Student::factory()->create();
        $abacus = Course::where('slug', 'abacus')->first();
        $vedic = Course::where('slug', 'vedic-maths')->first();
        $phonics = Course::where('slug', 'phonics')->first();

        // 1. First certificate: Abacus -> SDIA-2026-ABA-01
        $c1Num = Certificate::generateCertificateNumber($abacus, 2026);
        $this->assertEquals('SDIA-2026-ABA-01', $c1Num);
        Certificate::factory()->create([
            'certificate_number' => $c1Num,
            'course_id' => $abacus->id,
            'student_id' => $student->id,
        ]);

        // 2. Second certificate: Vedic Maths -> SDIA-2026-VM-02 (continuous!)
        $c2Num = Certificate::generateCertificateNumber($vedic, 2026);
        $this->assertEquals('SDIA-2026-VM-02', $c2Num);
        Certificate::factory()->create([
            'certificate_number' => $c2Num,
            'course_id' => $vedic->id,
            'student_id' => $student->id,
        ]);

        // 3. Third certificate: Abacus -> SDIA-2026-ABA-03 (continuous!)
        $c3Num = Certificate::generateCertificateNumber($abacus, 2026);
        $this->assertEquals('SDIA-2026-ABA-03', $c3Num);
        Certificate::factory()->create([
            'certificate_number' => $c3Num,
            'course_id' => $abacus->id,
            'student_id' => $student->id,
        ]);

        // 4. Fourth certificate: Phonics -> SDIA-2026-PHO-04 (continuous!)
        $c4Num = Certificate::generateCertificateNumber($phonics, 2026);
        $this->assertEquals('SDIA-2026-PHO-04', $c4Num);
        Certificate::factory()->create([
            'certificate_number' => $c4Num,
            'course_id' => $phonics->id,
            'student_id' => $student->id,
        ]);

        // 5. Fifth certificate: Abacus -> SDIA-2026-ABA-05 (continuous!)
        $c5Num = Certificate::generateCertificateNumber($abacus, 2026);
        $this->assertEquals('SDIA-2026-ABA-05', $c5Num);
        Certificate::factory()->create([
            'certificate_number' => $c5Num,
            'course_id' => $abacus->id,
            'student_id' => $student->id,
        ]);
    }
}
