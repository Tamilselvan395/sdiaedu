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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('address')->nullable()->after('state');
            $table->string('pincode', 20)->nullable()->after('address');
            $table->string('phone', 50)->nullable()->after('pincode');
            $table->string('email', 150)->nullable()->after('phone');
            $table->text('map_embed_url')->nullable()->after('email');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['address', 'pincode', 'phone', 'email', 'map_embed_url', 'sort_order']);
        });
    }
};
