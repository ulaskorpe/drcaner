<?php

use App\Models\EmailContent;
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
        Schema::create('model_has_revisions', function (Blueprint $table) {
            $table->foreignId('revision_id')->constrained()->onDelete('cascade');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id','model_type'], 'model_has_revisins_foreign_key_index');
            $table->primary(['revision_id','model_id','model_type']);
        });

        $email_types = config('enums.email_types');

        foreach ($email_types as $key => $mail) {
            EmailContent::create([
                'name' => $mail['label'],
                'use_for' => $mail['value'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_revisions');
    }
};
