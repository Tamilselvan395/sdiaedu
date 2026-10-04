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
            if (Schema::hasColumn('enquiries', 'name') && ! Schema::hasColumn('enquiries', 'parent_name')) {
                $table->renameColumn('name', 'parent_name');
            }
            if (! Schema::hasColumn('enquiries', 'student_name')) {
                $table->string('student_name')->nullable()->after('parent_name');
            }
            if (Schema::hasColumn('enquiries', 'learner_age') && ! Schema::hasColumn('enquiries', 'student_age')) {
                $table->renameColumn('learner_age', 'student_age');
            }
            if (! Schema::hasColumn('enquiries', 'mode_preference')) {
                $table->string('mode_preference')->nullable();
            }
            if (Schema::hasColumn('enquiries', 'message') && Schema::hasColumn('enquiries', 'notes')) {
                $table->dropColumn('message');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumnIfExists('student_name');
            $table->dropColumnIfExists('mode_preference');
        });
    }
};
