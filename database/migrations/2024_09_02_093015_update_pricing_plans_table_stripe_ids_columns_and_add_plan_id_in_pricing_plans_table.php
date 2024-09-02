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
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->string('stripe_product_id')->nullable(true)->change();
            $table->string('stripe_price_id')->nullable(true)->change();
            $table->string('stripe_plan_id')->nullable(true)->after('stripe_price_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->string('stripe_product_id')->nullable(false)->change();
            $table->string('stripe_price_id')->nullable(false)->change();
            $table->dropColumn('stripe_plan_id');
        });
    }
};
