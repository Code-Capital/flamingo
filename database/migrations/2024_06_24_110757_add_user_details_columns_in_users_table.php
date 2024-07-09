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
            $table->after('remember_token', function ($table) {
                $table->enum('gender', ['male', 'female', 'other'])->default('male')->nullable();
                $table->string('age')->nullable();
                $table->string('country')->nullable();
                $table->string('state')->nullable();
                $table->text('bio')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'age', 'country', 'state', 'bio']);
        });
    }
};
