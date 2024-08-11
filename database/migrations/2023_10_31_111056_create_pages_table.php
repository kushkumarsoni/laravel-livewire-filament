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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('short_description')->default(NULL)->nullable();
            $table->longText('description')->default(NULL)->nullable();
            $table->text('meta_title')->default(NULL)->nullable();
            $table->text('meta_tags')->default(NULL)->nullable();
            $table->text('meta_description')->default(NULL)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>active,0=>inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
