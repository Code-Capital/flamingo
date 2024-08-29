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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('sub_event_create_count')->default(0);
            $table->string('un_sub_event_create_count')->default(0);
            $table->string('sub_event_join_count')->default(0);
            $table->string('un_sub_event_join_count')->default(0);
            $table->string('sub_page_create_count')->default(0);
            $table->string('un_sub_page_create_count')->default(0);
            $table->string('sub_page_join_count')->default(0);
            $table->string('un_sub_page_join_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
