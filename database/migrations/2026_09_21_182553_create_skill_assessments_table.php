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
        Schema::create('skill_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('skill_assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_assessment_id')->constrained('skill_assessments')->cascadeOnDelete();
            $table->integer('step')->default(1);
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('question_type')->default('single_choice'); // single_choice, multi_choice, text
            $table->json('options')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('skill_assessment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_assessment_id')->nullable()->constrained('skill_assessments')->nullOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('learner_age')->nullable();
            $table->string('location')->nullable();
            $table->json('answers')->nullable();
            $table->json('recommended_courses')->nullable();
            $table->foreignId('enquiry_id')->nullable()->constrained('enquiries')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_assessment_submissions');
        Schema::dropIfExists('skill_assessment_questions');
        Schema::dropIfExists('skill_assessments');
    }
};
