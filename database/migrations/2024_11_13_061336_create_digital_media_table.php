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
        Schema::create('digital_media', function (Blueprint $table) {
           
            $table->id(); 
            $table->string('title'); 
            $table->string('author')->nullable(); 
            $table->text('description')->nullable(); 
            $table->text('content')->nullable(); 
            $table->string('url')->nullable(); 
            $table->string('url_image')->nullable(); 
            $table->dateTime('published_at')->nullable(); 
            $table->string('category')->nullable(); 
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_media');
    }
};
