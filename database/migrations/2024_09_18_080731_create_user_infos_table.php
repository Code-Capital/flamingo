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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('municipality')->nullable();
            $table->string('dog_breed')->nullable();
            $table->string('dog_gender')->nullable();
            $table->string('kennel_club')->nullable();
            $table->string('dog_working_club')->nullable();
            $table->string('dog_withers_height')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->string('castrated')->nullable();
            $table->string('target')->nullable();
            $table->string('furr')->nullable();
            $table->string('drawing')->nullable();
            $table->string('hills')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
