<?php

namespace Database\Seeders;

use App\Enums\CertificateStatus;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstCourse = Course::first();
        $courseId = $firstCourse ? $firstCourse->id : 1;

        $records = [
            [
                'student' => [
                    'student_code' => 'STU-26737',
                    'first_name' => 'NANTHINI',
                    'last_name' => 'VENKAT',
                    'gender' => 'Female',
                    'city' => 'Chennai',
                    'state' => 'Tamil Nadu',
                    'status' => 'Active',
                ],
                'certificate' => [
                    'certificate_number' => 'SMTCERCD26737',
                    'course_id' => 1,
                    'exam_session' => 'JULY 2026',
                    'total_marks' => '627 / 700',
                    'percentage' => '90%',
                    'division' => 'Distinction',
                    'result_status' => 'PASSED',
                    'issue_date' => '2026-07-07',
                    'completion_date' => '2026-06-30',
                    'grade' => 'Distinction',
                    'status' => CertificateStatus::Valid,
                    'subject_marks' => [
                        ['subject' => 'FOUNDATIONS OF EDUCATIONAL PSYCHOLOGY (CMTC001)', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'PRE SCHOOL EDUCATION', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'PRE SCHOOL MANAGEMENT', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'MONTESSORI PHILOSOPHY AND METHOD (CMTC004)', 'obtained' => 92, 'maximum' => 100],
                        ['subject' => 'TEACHING PRACTICE/ INTERNSHIP', 'obtained' => 96, 'maximum' => 100],
                        ['subject' => 'PRACTICAL EXAMINATION VIVA VOCE (CMTC006)', 'obtained' => 72, 'maximum' => 100],
                        ['subject' => 'PRACTICAL TRAINING AND RECORD', 'obtained' => 82, 'maximum' => 100],
                    ],
                ],
            ],
            [
                'student' => [
                    'student_code' => 'STU-10021',
                    'first_name' => 'Aarav',
                    'last_name' => 'Sundaram',
                    'gender' => 'Male',
                    'city' => 'Coimbatore',
                    'state' => 'Tamil Nadu',
                    'status' => 'Active',
                ],
                'certificate' => [
                    'certificate_number' => 'SDIA-2026-ABA-01',
                    'course_slug' => 'abacus',
                    'exam_session' => 'JANUARY 2026',
                    'total_marks' => '482 / 500',
                    'percentage' => '96%',
                    'division' => 'Distinction',
                    'result_status' => 'PASSED',
                    'issue_date' => '2026-01-15',
                    'completion_date' => '2026-01-10',
                    'grade' => 'A+ (Distinction)',
                    'status' => CertificateStatus::Valid,
                    'subject_marks' => [
                        ['subject' => 'SPEED & MENTAL ARITHMETIC (ADDITION & SUBTRACTION)', 'obtained' => 98, 'maximum' => 100],
                        ['subject' => 'ADVANCED MULTIPLICATION (DECIMAL & WHOLE)', 'obtained' => 96, 'maximum' => 100],
                        ['subject' => 'RAPID DIVISION & FRACTION MASTERY', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'ORAL DICTATION & FLASH ANZAN SPEED TEST', 'obtained' => 97, 'maximum' => 100],
                        ['subject' => 'APPLIED LOGICAL REASONING & ACCURACY', 'obtained' => 96, 'maximum' => 100],
                    ],
                ],
            ],
            [
                'student' => [
                    'student_code' => 'STU-10045',
                    'first_name' => 'Diya',
                    'last_name' => 'Karthikeyan',
                    'gender' => 'Female',
                    'city' => 'Chennai',
                    'state' => 'Tamil Nadu',
                    'status' => 'Active',
                ],
                'certificate' => [
                    'certificate_number' => 'SDIA-2026-VM-02',
                    'course_slug' => 'vedic-maths',
                    'exam_session' => 'FEBRUARY 2026',
                    'total_marks' => '470 / 500',
                    'percentage' => '94%',
                    'division' => 'Distinction',
                    'result_status' => 'PASSED',
                    'issue_date' => '2026-02-20',
                    'completion_date' => '2026-02-18',
                    'grade' => 'A (High Honors)',
                    'status' => CertificateStatus::Valid,
                    'subject_marks' => [
                        ['subject' => 'SPEED SUTRAS & VEDIC MULTIPLICATION', 'obtained' => 96, 'maximum' => 100],
                        ['subject' => 'SQUARE ROOTS & CUBE ROOTS EXTRACTION', 'obtained' => 94, 'maximum' => 100],
                        ['subject' => 'ALGEBRAIC FACTORIZATION & EQUATIONS', 'obtained' => 92, 'maximum' => 100],
                        ['subject' => 'SPECIAL DIVISION BY NIKHILAM SUTRA', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'SPEED TIMED DRILLS & SPEED EVALUATION', 'obtained' => 93, 'maximum' => 100],
                    ],
                ],
            ],
            [
                'student' => [
                    'student_code' => 'STU-10089',
                    'first_name' => 'Kavya',
                    'last_name' => 'Natarajan',
                    'gender' => 'Female',
                    'city' => 'Bangalore',
                    'state' => 'Karnataka',
                    'status' => 'Active',
                ],
                'certificate' => [
                    'certificate_number' => 'SDIA-2026-ABA-03',
                    'course_slug' => 'abacus',
                    'exam_session' => 'MARCH 2026',
                    'total_marks' => '475 / 500',
                    'percentage' => '95%',
                    'division' => 'Distinction',
                    'result_status' => 'PASSED',
                    'issue_date' => '2026-03-12',
                    'completion_date' => '2026-03-05',
                    'grade' => 'A+ (First Class with Distinction)',
                    'status' => CertificateStatus::Valid,
                    'subject_marks' => [
                        ['subject' => 'SPEED & MENTAL ARITHMETIC (ADDITION & SUBTRACTION)', 'obtained' => 96, 'maximum' => 100],
                        ['subject' => 'ADVANCED MULTIPLICATION (DECIMAL & WHOLE)', 'obtained' => 94, 'maximum' => 100],
                        ['subject' => 'RAPID DIVISION & FRACTION MASTERY', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'ORAL DICTATION & FLASH ANZAN SPEED TEST', 'obtained' => 95, 'maximum' => 100],
                        ['subject' => 'APPLIED LOGICAL REASONING & ACCURACY', 'obtained' => 95, 'maximum' => 100],
                    ],
                ],
            ],
            [
                'student' => [
                    'student_code' => 'STU-10112',
                    'first_name' => 'Rohan',
                    'last_name' => 'Venkatesh',
                    'gender' => 'Male',
                    'city' => 'Coimbatore',
                    'state' => 'Tamil Nadu',
                    'status' => 'Active',
                ],
                'certificate' => [
                    'certificate_number' => 'SDIA-2026-PHO-04',
                    'course_slug' => 'phonics',
                    'exam_session' => 'APRIL 2026',
                    'total_marks' => '468 / 500',
                    'percentage' => '94%',
                    'division' => 'Distinction',
                    'result_status' => 'PASSED',
                    'issue_date' => '2026-04-20',
                    'completion_date' => '2026-04-15',
                    'grade' => 'A (Excellence)',
                    'status' => CertificateStatus::Valid,
                    'subject_marks' => [
                        ['subject' => 'PHONEMIC AWARENESS & BLENDING', 'obtained' => 94, 'maximum' => 100],
                        ['subject' => 'DIGRAPHS & DIPHTHONGS MASTERY', 'obtained' => 96, 'maximum' => 100],
                        ['subject' => 'SPEED DECODING & ORAL READING FLUENCY', 'obtained' => 93, 'maximum' => 100],
                        ['subject' => 'COMPREHENSION & SIGHT WORD RECALL', 'obtained' => 92, 'maximum' => 100],
                        ['subject' => 'ORAL SPELLING & DICTATION ACCURACY', 'obtained' => 93, 'maximum' => 100],
                    ],
                ],
            ],
            [
                'student' => [
                    'student_code' => 'STU-10250',
                    'first_name' => 'Sai',
                    'last_name' => 'Pranav',
                    'gender' => 'Male',
                    'city' => 'Chennai',
                    'state' => 'Tamil Nadu',
                    'status' => 'Active',
                ],
                'certificate' => [
                    'certificate_number' => 'SDIA-2026-ABA-05',
                    'course_slug' => 'abacus',
                    'exam_session' => 'MAY 2026',
                    'total_marks' => '490 / 500',
                    'percentage' => '98%',
                    'division' => 'Distinction',
                    'result_status' => 'PASSED',
                    'issue_date' => '2026-05-18',
                    'completion_date' => '2026-05-10',
                    'grade' => 'A+ (Distinction)',
                    'status' => CertificateStatus::Valid,
                    'subject_marks' => [
                        ['subject' => 'SPEED & MENTAL ARITHMETIC (ADDITION & SUBTRACTION)', 'obtained' => 99, 'maximum' => 100],
                        ['subject' => 'ADVANCED MULTIPLICATION (DECIMAL & WHOLE)', 'obtained' => 98, 'maximum' => 100],
                        ['subject' => 'RAPID DIVISION & FRACTION MASTERY', 'obtained' => 97, 'maximum' => 100],
                        ['subject' => 'ORAL DICTATION & FLASH ANZAN SPEED TEST', 'obtained' => 98, 'maximum' => 100],
                        ['subject' => 'APPLIED LOGICAL REASONING & ACCURACY', 'obtained' => 98, 'maximum' => 100],
                    ],
                ],
            ],
        ];

        foreach ($records as $item) {
            $student = Student::updateOrCreate(
                ['student_code' => $item['student']['student_code']],
                $item['student']
            );

            $certData = $item['certificate'];
            $targetCourseId = $courseId;
            if (! empty($certData['course_slug'])) {
                $foundCourse = Course::where('slug', $certData['course_slug'])->first();
                if ($foundCourse) {
                    $targetCourseId = $foundCourse->id;
                }
                unset($certData['course_slug']);
            }

            Certificate::updateOrCreate(
                ['certificate_number' => $certData['certificate_number']],
                array_merge($certData, [
                    'student_id' => $student->id,
                    'course_id' => $targetCourseId,
                ])
            );
        }
    }
}
