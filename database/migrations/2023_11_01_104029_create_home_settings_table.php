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
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default(NULL)->nullable();
            $table->string('sub_title')->default(NULL)->nullable();
            $table->text('description')->default(NULL)->nullable();
            $table->string('btn_text')->default(NULL)->nullable();
            $table->string('btn_link')->default(NULL)->nullable();
            $table->string('image')->default(NULL)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
