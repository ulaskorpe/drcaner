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
        Schema::create('commercial_ads', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');

            $table->foreignId('commercial_ad_area_id')
                ->references('id')
                ->on('commercial_ad_areas');

            $table->string('language',3)->default(config('languages.default'));
            $table->boolean('is_published')->default(false);

            $table->foreignId('main_image_id')
                ->references('id')
                ->on('media')
                ->onDelete('cascade');

            $table->mediumText('link');
            $table->unsignedBigInteger('click_count')->default(0);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_ads');
    }
};
