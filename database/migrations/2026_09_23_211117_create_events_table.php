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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('mode')->default('In-Person'); // In-Person, Live Online, Hybrid
            $table->string('location_name')->nullable();
            $table->text('location_address')->nullable();
            $table->decimal('registration_fee', 8, 2)->default(0.00);
            $table->string('registration_url')->nullable();
            $table->string('cta_button_text')->default('Register Now');
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('show_popup')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
