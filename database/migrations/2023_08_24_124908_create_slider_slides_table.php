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
        Schema::create('slider_slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->references('id')
            ->on('sliders')
            ->onDelete('cascade');
            $table->string('title')->nullable();
            $table->tinyText('description')->nullable();
            $table->json('image')->nullable();
            $table->json('mobile_image')->nullable();
            $table->json('video')->nullable();
            $table->json('json_data')->nullable();
            $table->unsignedInteger('order_column')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_slides');
    }
};
