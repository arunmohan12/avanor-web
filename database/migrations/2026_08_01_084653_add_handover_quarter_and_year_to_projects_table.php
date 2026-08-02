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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('handover_quarter')
                ->nullable()
                ->after('handover_date');
    
            $table->year('handover_year')
                ->nullable()
                ->after('handover_quarter');
        });
    }
    
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'handover_quarter',
                'handover_year'
            ]);
        });
    }
};
