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
        Schema::table('properties', function (Blueprint $table) {
    
            $table->decimal('starting_price', 15, 2)
                ->nullable()
                ->after('price');
    
            $table->string('handover_quarter', 2)
                ->nullable()
                ->after('starting_price');
    
            $table->unsignedSmallInteger('handover_year')
                ->nullable()
                ->after('handover_quarter');
    
        });
    }
    
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'starting_price',
                'handover_quarter',
                'handover_year',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */

};
