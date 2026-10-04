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
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('gclid', 100)->nullable()->after('utm_content')->index();
            $table->string('fbclid', 100)->nullable()->after('gclid')->index();
            $table->string('msclkid', 100)->nullable()->after('fbclid');
            $table->string('fbp', 100)->nullable()->after('msclkid');
            $table->string('fbc', 100)->nullable()->after('fbp');
            $table->string('ip_address', 45)->nullable()->after('fbc');
            $table->text('user_agent')->nullable()->after('ip_address');
            $table->boolean('consent_given')->default(true)->after('user_agent');
            $table->timestamp('offline_conversion_synced_at')->nullable()->after('consent_given');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn([
                'gclid',
                'fbclid',
                'msclkid',
                'fbp',
                'fbc',
                'ip_address',
                'user_agent',
                'consent_given',
                'offline_conversion_synced_at',
            ]);
        });
    }
};
