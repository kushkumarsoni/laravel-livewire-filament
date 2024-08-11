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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->default(NULL)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->default(NULL)->nullabe()->constrained('categories','id')->cascadeOnDelete();
            $table->text('meta_title')->default(NULL)->nullable();
            $table->text('meta_description')->default(NULL)->nullable();
            $table->text('meta_tags')->default(NULL)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>active,0=>inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
