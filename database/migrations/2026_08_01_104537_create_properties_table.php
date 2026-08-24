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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('developer_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('emirate_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('community_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Basic details
            $table->string('title');
            $table->string('slug')->unique();

            // Classification
            $table->foreignId('property_type_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('status')->default('available');

            // Property details
            $table->unsignedInteger('bedrooms')->nullable();
            $table->unsignedInteger('bathrooms')->nullable();

            $table->decimal('price', 12, 2)->nullable();

            // Media
            $table->string('thumbnail')->nullable();
            $table->string('cover_image')->nullable();

            // Location
            $table->text('map_url')->nullable();

            // Content
            $table->text('description')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Control
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
