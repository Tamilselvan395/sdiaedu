<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseCategorySeeder::class,
            CourseSeeder::class,
            CourseContentSeeder::class,
            SettingSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
            BlogSeeder::class,
            SkillAssessmentSeeder::class,
            CertificateSeeder::class,
            EventSeeder::class,
            LocationSeeder::class,
            TeacherCourseSeeder::class,
        ]);
    }
}
