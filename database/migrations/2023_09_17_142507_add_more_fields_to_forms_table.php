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
        Schema::table('forms', function (Blueprint $table) {
            $table->string('sender_name');
            $table->string('to_email');
            $table->string('subject');
            $table->string('button_text')->default('Gönder');
            $table->enum('success_type',['message','redirect'])->default('message');
            $table->tinyText('success_message')->nullable();
            $table->tinyText('success_uri')->nullable();
            $table->text('success_script')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            //
        });
    }
};
