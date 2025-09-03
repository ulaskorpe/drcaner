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
        Schema::create('content_attributes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            
            $option_types = [];

            if( config('enums.option_types') && count(config('enums.option_types')) > 0 ){
                foreach (config('enums.option_types') as $key => $value) {
                    $option_types[] = $value['value'];
                }
                $table->enum('option_type',$option_types);
            } else {
                $table->string('option_type',30);
            }

            $table->boolean('fe_visible')->default(true);
            $table->boolean('is_required')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('order_column')->nullable()->index();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_attributes');
    }
};
