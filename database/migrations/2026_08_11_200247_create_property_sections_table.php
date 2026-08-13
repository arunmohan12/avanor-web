<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_sections', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('property_id')
                ->constrained()
                ->cascadeOnDelete();
    
            $table->string('title')->nullable();
    
            $table->longText('content')->nullable();
    
            $table->string('image')->nullable();
    
            $table->enum('layout', [
                'image_left',
                'image_right',
                'full_width',
            ])->default('image_left');
    
            $table->unsignedInteger('display_order')
                ->default(0);
    
            $table->boolean('is_active')
                ->default(true);
    
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('property_sections');
    }
};
