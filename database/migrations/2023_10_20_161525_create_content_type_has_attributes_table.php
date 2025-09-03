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
        Schema::create('content_type_has_attributes', function (Blueprint $table) {

            $table->unsignedBigInteger('content_attribute_id');
            $table->unsignedBigInteger('content_type_id');

            $table->foreign('content_attribute_id')
                ->references('id')
                ->on('content_attributes')
                ->onDelete('cascade');

            $table->foreign('content_type_id')
                ->references('id')
                ->on('content_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['content_attribute_id','content_type_id'],'content_type_has_attributes_content_attribute_id_content_type_id_primary');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_type_has_attributes');
    }
};
