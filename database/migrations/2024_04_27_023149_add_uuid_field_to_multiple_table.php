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
        Schema::table('content_attributes', function (Blueprint $table) {
            $table->uuid();
        });

        Schema::table('content_attribute_values', function (Blueprint $table) {
            $table->uuid();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->uuid();
        });

        Schema::table('taxonomies', function (Blueprint $table) {
            $table->uuid();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
