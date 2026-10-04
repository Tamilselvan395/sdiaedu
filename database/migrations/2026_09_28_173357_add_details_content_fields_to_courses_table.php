<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('batch_ratio')->nullable()->default('Max 1 : 8 Mentorship')->after('duration');
            $table->string('credential_info')->nullable()->default('ISO 9001 Certified')->after('batch_ratio');
            $table->json('what_students_gain')->nullable()->after('who_is_for');
            $table->boolean('has_teacher_training')->default(true)->after('what_students_gain');
            $table->string('teacher_training_title')->nullable()->after('has_teacher_training');
            $table->text('teacher_training_description')->nullable()->after('teacher_training_title');
            $table->json('teacher_training_highlights')->nullable()->after('teacher_training_description');
            $table->json('institution_highlights')->nullable()->after('why_choose');
            $table->json('guarantee_checklist')->nullable()->after('class_schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'batch_ratio',
                'credential_info',
                'what_students_gain',
                'has_teacher_training',
                'teacher_training_title',
                'teacher_training_description',
                'teacher_training_highlights',
                'institution_highlights',
                'guarantee_checklist',
            ]);
        });
    }
};
