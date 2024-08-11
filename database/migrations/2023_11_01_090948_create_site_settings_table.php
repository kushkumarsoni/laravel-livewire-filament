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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default(NULL)->nullable();
            $table->string('logo')->default(NULL)->nullable();
            $table->string('email')->default(NULL)->nullable();
            $table->string('mobile')->default(NULL)->nullable();
            $table->string('pincode')->default(NULL)->nullable();
            $table->text('address')->default(NULL)->nullable();
            $table->string('facebook')->default(NULL)->nullable();            
            $table->string('instagram')->default(NULL)->nullable();            
            $table->string('twitter')->default(NULL)->nullable();            
            $table->string('meta_title')->default(NULL)->nullable();            
            $table->longText('meta_description')->default(NULL)->nullable();            
            $table->longText('meta_keywords')->default(NULL)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
