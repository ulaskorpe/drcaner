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
        Schema::table('contents', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('content_attributes', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('content_attribute_values', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('content_categories', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('content_types', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('layouts', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('sidebars', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('slug_org')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('slug_org');
        });
        */
    }
};
