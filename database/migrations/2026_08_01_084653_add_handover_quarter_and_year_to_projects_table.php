<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('projects', 'handover_quarter')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('handover_quarter')->nullable();
            });
        }

        if (! Schema::hasColumn('projects', 'handover_year')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->unsignedSmallInteger('handover_year')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'handover_quarter')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('handover_quarter');
            });
        }

        if (Schema::hasColumn('projects', 'handover_year')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('handover_year');
            });
        }
    }
};