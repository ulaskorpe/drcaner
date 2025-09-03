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
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->string('billing_type')->nullable();
            $table->unsignedBigInteger('tc_no')->nullable();
            $table->string('vd')->nullable();
            $table->string('vkn')->nullable();
            $table->boolean('use_for_billing')->default(true);
            $table->boolean('e_fatura')->default(false);
            $table->string('company_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            //
        });
    }
};
