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
        Schema::create('event_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('participant_name')->index();
            $table->string('registration_number')->nullable()->index();
            $table->string('certificate_number')->nullable()->index();
            $table->string('certificate_title')->default('Certificate of Participation');
            $table->string('certificate_file');
            $table->string('mobile', 30)->nullable();
            $table->string('email')->nullable();
            $table->text('remarks')->nullable();
            $table->date('issue_date')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_certificates');
    }
};
