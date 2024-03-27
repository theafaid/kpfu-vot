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
        Schema::create('group_language', function (Blueprint $table) {
            $table->unsignedSmallInteger('group_id')->index();
            $table->unsignedSmallInteger('language_id')->index();

            $table->unique(['group_id', 'language_id']);
            $table->foreign('group_id')->references('id')
                ->on('groups')->onDelete('cascade');
            $table->foreign('language_id')->references('id')
                ->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_lang');
    }
};
