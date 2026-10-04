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
        Schema::table('certificates', function (Blueprint $table) {
            if (! Schema::hasColumn('certificates', 'exam_session')) {
                $table->string('exam_session')->nullable()->after('completion_date');
            }
            if (! Schema::hasColumn('certificates', 'total_marks')) {
                $table->string('total_marks')->nullable()->after('exam_session');
            }
            if (! Schema::hasColumn('certificates', 'percentage')) {
                $table->string('percentage')->nullable()->after('total_marks');
            }
            if (! Schema::hasColumn('certificates', 'division')) {
                $table->string('division')->nullable()->after('percentage');
            }
            if (! Schema::hasColumn('certificates', 'result_status')) {
                $table->string('result_status')->default('PASSED')->after('division');
            }
            if (! Schema::hasColumn('certificates', 'subject_marks')) {
                $table->json('subject_marks')->nullable()->after('result_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn([
                'exam_session',
                'total_marks',
                'percentage',
                'division',
                'result_status',
                'subject_marks',
            ]);
        });
    }
};
