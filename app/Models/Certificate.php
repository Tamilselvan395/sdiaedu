<?php

namespace App\Models;

use App\Enums\CertificateStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function (Certificate $certificate) {
            if (empty($certificate->certificate_number)) {
                $certificate->certificate_number = static::generateCertificateNumber($certificate->course_id);
            }
        });
    }

    /**
     * Resolve short course code for certificate numbering.
     */
    public static function getCourseShortCode(Course|int|string|null $course): string
    {
        if (! $course) {
            return 'CRS';
        }

        if (is_numeric($course)) {
            $course = Course::find($course);
        } elseif (is_string($course) && ! is_numeric($course)) {
            $course = Course::where('slug', $course)->first() ?? Course::where('title', $course)->first();
        }

        if ($course instanceof Course && ! empty($course->short_code)) {
            return strtoupper(trim($course->short_code));
        }

        $slug = $course instanceof Course ? $course->slug : (is_string($course) ? $course : null);

        $slugMap = [
            'abacus' => 'ABA',
            'vedic-maths' => 'VM',
            'phonics' => 'PHO',
            'mid-brain-activation' => 'MBA',
            'quantum-speed-reading' => 'QSR',
            'spellbee' => 'SPB',
            'rubiks-cube' => 'RC',
            'chess' => 'CHS',
            'drawing-and-coloring' => 'DNC',
            'drawing' => 'DNC',
            'art-and-craft' => 'ANC',
            'calligraphy' => 'CAL',
            'handwriting' => 'HW',
            'carnatic-music' => 'CM',
            'keyboard' => 'KB',
            'classical-dance' => 'CD',
            'western-and-folk-dance' => 'WFD',
            'karate' => 'KAR',
            'silambam' => 'SIL',
            'yoga' => 'YOG',
            'zumba-and-fitness' => 'ZUM',
            'zumba' => 'ZUM',
            'gymnastics' => 'GYM',
            'carrom' => 'CRM',
            'dart' => 'DRT',
            'spoken-english' => 'ENG',
            'hindi-saba-exams' => 'HIN',
            'spoken-hindi' => 'HIN',
            'international-montessori' => 'MTT',
            'beautician' => 'BCN',
            'personality-development' => 'PD',
            'm3-analytical' => 'M3',
            'pencil-art' => 'PCL',
            'social-media-marketing' => 'SMM',
            'web-designing' => 'WEB',
        ];

        if (! empty($slug) && isset($slugMap[$slug])) {
            return $slugMap[$slug];
        }

        if ($course instanceof Course && ! empty($course->slug)) {
            $firstPart = explode('-', $course->slug)[0];

            return strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $firstPart), 0, 4));
        }

        if ($course instanceof Course && ! empty($course->title)) {
            $firstWord = explode(' ', $course->title)[0] ?? 'CRS';

            return strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $firstWord), 0, 4));
        }

        return 'CRS';
    }

    /**
     * Auto-generate a continuous, unique Certificate Number.
     * Format: SDIA-{YEAR}-{COURSE_SHORTCODE}-{NUMBER}
     * Examples:
     *   SDIA-2026-ABA-01
     *   SDIA-2026-VM-02
     *   SDIA-2026-ABA-03
     *   SDIA-2026-PHO-04
     *   SDIA-2026-ABA-05
     *
     * The number sequence increments continuously across all academy certificates for the specified year.
     */
    public static function generateCertificateNumber(Course|int|string|null $course = null, ?int $year = null): string
    {
        $year = $year ?? (int) date('Y');
        $shortCode = static::getCourseShortCode($course);

        // Find all certificates for this year matching SDIA-{YEAR}-...
        $existingNumbers = static::where('certificate_number', 'LIKE', "SDIA-{$year}-%")
            ->pluck('certificate_number');

        $maxSeq = 0;
        foreach ($existingNumbers as $num) {
            // Match SDIA-YYYY-CODE-XX where XX is the numeric sequence at the end
            if (preg_match('/^SDIA-'.$year.'-[A-Z0-9]+-(\d+)$/i', $num, $matches)) {
                $seq = (int) $matches[1];
                if ($seq > $maxSeq) {
                    $maxSeq = $seq;
                }
            }
        }

        $nextSeq = $maxSeq + 1;
        $formattedSeq = sprintf('%02d', $nextSeq);
        $candidate = "SDIA-{$year}-{$shortCode}-{$formattedSeq}";

        while (static::where('certificate_number', $candidate)->exists()) {
            $nextSeq++;
            $formattedSeq = sprintf('%02d', $nextSeq);
            $candidate = "SDIA-{$year}-{$shortCode}-{$formattedSeq}";
        }

        return $candidate;
    }

    /**
     * Static certified courses directory (not loaded from courses database table).
     *
     * @var array<int|string, string>
     */
    /**
     * Static certified courses directory (not loaded from courses database table).
     *
     * @var array<int|string, string>
     */
    public const STATIC_COURSES = [
        1 => 'POSTGRADUATE DIPLOMA IN MONTESSORI TEACHER TRAINING (MTTC)',
        2 => 'ABACUS MENTAL ARITHMETIC & SPEED MATH (LEVEL 8)',
        3 => 'SPEED VEDIC MATHEMATICS & ADVANCED ALGEBRA',
        4 => 'CLASSICAL CARNATIC VOCAL & MUSIC DIPLOMA',
        5 => 'BHARATANATYAM CLASSICAL DANCE CERTIFICATION',
        6 => 'WESTERN PIANO & KEYBOARD PERFORMANCE',
        7 => 'CLASSICAL VIOLIN & INSTRUMENTAL MUSIC',
        8 => 'FINE ARTS, OIL PAINTING & VISUAL SKETCHING',
        9 => 'PUBLIC SPEAKING, ORATORY & DEBATING MASTERY',
        10 => 'ROBOTICS, MICROCONTROLLER LAB & STEM INNOVATION',
        11 => 'PYTHON PROGRAMMING & ARTIFICIAL INTELLIGENCE',
        12 => 'YOGA, ASANA ALIGNMENT & HOLISTIC WELLNESS',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'completion_date' => 'date',
            'status' => CertificateStatus::class,
            'subject_marks' => 'array',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the static course title without querying the courses database.
     */
    public function getStaticCourseTitleAttribute(): string
    {
        if (! empty($this->attributes['course_name'])) {
            return $this->attributes['course_name'];
        }

        if (! empty($this->course_id) && isset(self::STATIC_COURSES[$this->course_id])) {
            return self::STATIC_COURSES[$this->course_id];
        }

        $index = ($this->id ? (($this->id - 1) % count(self::STATIC_COURSES)) + 1 : 1);

        return self::STATIC_COURSES[$index] ?? 'POSTGRADUATE DIPLOMA IN MONTESSORI TEACHER TRAINING (MTTC)';
    }

    /**
     * Return subject-wise marks from database or realistic static fallback.
     *
     * @return array<int, array{subject: string, obtained: int, maximum: int}>
     */
    public function getFormattedSubjectMarksAttribute(): array
    {
        if (! empty($this->subject_marks) && is_array($this->subject_marks)) {
            return $this->subject_marks;
        }

        // Default subject marks matching Montessori Teacher Training & holistic tracks
        return [
            ['subject' => 'FOUNDATIONS OF EDUCATIONAL PSYCHOLOGY (CMTC001)', 'obtained' => 95, 'maximum' => 100],
            ['subject' => 'PRE SCHOOL EDUCATION', 'obtained' => 95, 'maximum' => 100],
            ['subject' => 'PRE SCHOOL MANAGEMENT', 'obtained' => 95, 'maximum' => 100],
            ['subject' => 'MONTESSORI PHILOSOPHY AND METHOD (CMTC004)', 'obtained' => 92, 'maximum' => 100],
            ['subject' => 'TEACHING PRACTICE/ INTERNSHIP', 'obtained' => 96, 'maximum' => 100],
            ['subject' => 'PRACTICAL EXAMINATION VIVA VOCE (CMTC006)', 'obtained' => 72, 'maximum' => 100],
            ['subject' => 'PRACTICAL TRAINING AND RECORD', 'obtained' => 82, 'maximum' => 100],
        ];
    }

    /**
     * Get total marks string (e.g. "627 / 700").
     */
    public function getFormattedTotalMarksAttribute(): string
    {
        if (! empty($this->total_marks)) {
            return $this->total_marks;
        }

        $marks = $this->formatted_subject_marks;
        $obtained = array_sum(array_column($marks, 'obtained'));
        $maximum = array_sum(array_column($marks, 'maximum'));

        return "{$obtained} / {$maximum}";
    }

    /**
     * Get percentage string (e.g. "90%").
     */
    public function getFormattedPercentageAttribute(): string
    {
        if (! empty($this->percentage)) {
            return str_ends_with($this->percentage, '%') ? $this->percentage : "{$this->percentage}%";
        }

        $marks = $this->formatted_subject_marks;
        $obtained = array_sum(array_column($marks, 'obtained'));
        $maximum = array_sum(array_column($marks, 'maximum'));

        if ($maximum > 0) {
            $pct = round(($obtained / $maximum) * 100);

            return "{$pct}%";
        }

        return '90%';
    }

    /**
     * Get division (e.g. "Distinction").
     */
    public function getFormattedDivisionAttribute(): string
    {
        return $this->division ?? $this->grade ?? 'Distinction';
    }

    /**
     * Get examination session (e.g. "JULY 2026").
     */
    public function getFormattedExamSessionAttribute(): string
    {
        if (! empty($this->exam_session)) {
            return strtoupper($this->exam_session);
        }

        return strtoupper($this->issue_date ? $this->issue_date->format('F Y') : 'JULY 2026');
    }

    /**
     * Return all static course options.
     *
     * @return array<int|string, string>
     */
    public static function getStaticCourses(): array
    {
        return self::STATIC_COURSES;
    }

    public function isValid(): bool
    {
        return $this->status === CertificateStatus::Valid;
    }
}
