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
            $table->after('age', function($table){
                $table->foreignId('country_id')->nullable()->constrained()->cascadeOnDelete();
                $table->foreignId('county_id')->nullable()->constrained()->cascadeOnDelete();
                $table->foreignId('state_id')->nullable()->constrained()->cascadeOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('county_id');
            $table->dropConstrainedForeignId('state_id');
        });
    }
};
