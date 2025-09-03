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
        Schema::table('design_templates', function (Blueprint $table) {
            $table->boolean('use_columns')->default(false);
            $table->boolean('use_rows')->default(false);
            $table->boolean('use_containers')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('design_templates', function (Blueprint $table) {
            //
        });
    }
};
