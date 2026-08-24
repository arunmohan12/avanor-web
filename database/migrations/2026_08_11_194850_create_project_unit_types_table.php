<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_unit_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('property_type_id')
                ->constrained()
                ->restrictOnDelete();

            $table->unsignedTinyInteger('bedrooms_from')
                ->nullable();

            $table->unsignedTinyInteger('bedrooms_to')
                ->nullable();

            $table->unsignedInteger('display_order')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_unit_types');
    }
};
