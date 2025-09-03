<?php

use App\Models\MediaModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        MediaModel::create(); //default id 1 olusturalim. baska olusturulmayacak tum media lari buna bagliycaz.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_models');
    }
};
