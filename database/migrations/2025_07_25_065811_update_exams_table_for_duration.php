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
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time']);
            $table->unsignedInteger('duration')->after('subject_id')->default(10); // duration in minutes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->timestamp('start_time')->nullable()->after('subject_id');
            $table->timestamp('end_time')->nullable()->after('start_time');
        });
    }
};
