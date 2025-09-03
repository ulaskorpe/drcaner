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
        Schema::create('content_previews', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->uuid('uuid');
            $table->unsignedInteger('content_type_id');
            $table->boolean('is_category')->default(false);
            $table->string('language',3);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->mediumText('summary')->nullable();
            $table->string('slug');
            $table->json('additional')->nullable();
            $table->boolean('is_published')->default(false);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->json('content')->nullable();
            $table->unsignedBigInteger('slider_id')->nullable();
            $table->json('attributes')->nullable();
            $table->string('slug_org')->nullable();
            $table->unsignedBigInteger('layout_id')->nullable();
            $table->unsignedBigInteger('header_layout_id')->nullable();
            $table->boolean('users_only')->default(false);

            $table->longText('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('read_count')->default(0);
            $table->json('pivot_data')->nullable();

            $table->unsignedBigInteger('depending_content_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_previews');
    }
};
