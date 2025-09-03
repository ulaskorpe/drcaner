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
            
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('read_count')->default(0);
            $table->json('pivot_data')->nullable();

        });

        Schema::table('content_types', function (Blueprint $table) {
            $table->string('content_mode',30)->default('content');
        });

        Schema::table('content_categories', function (Blueprint $table) {
            $table->json('pivot_data')->nullable();
        });

        Schema::table('content_attributes', function (Blueprint $table) {
            $table->json('pivot_data')->nullable();
        });

        Schema::table('content_attribute_values', function (Blueprint $table) {
            $table->json('pivot_data')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->json('pivot_data')->nullable();
        });

        Schema::table('forms', function (Blueprint $table) {
            $table->unsignedBigInteger('email_content_id')->nullable();
            $table->string('cc_email')->nullable();
            $table->string('bcc_email')->nullable();
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
