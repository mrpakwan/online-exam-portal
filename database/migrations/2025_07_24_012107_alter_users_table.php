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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->onDelete('cascade')->after('password');
            $table->foreignId('class_group_id')->nullable()->constrained()->onDelete('set null')->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_group_id']);
            $table->dropColumn('class_group_id');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
