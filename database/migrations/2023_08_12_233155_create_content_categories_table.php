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
        Schema::create('content_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->uuid('uuid');
            $table->foreignId('content_type_id')->references('id')
            ->on('content_types')
            ->onDelete('cascade');
            $table->string('language',3);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->mediumText('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('slug');
            $table->json('additional')->nullable();
            $table->boolean('is_published')->default(false);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            $table->unsignedInteger('order_column')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_categories');
    }
};
