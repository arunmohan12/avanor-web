<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('status', 30)
                ->default('new')
                ->after('source');

            $table->text('note')
                ->nullable()
                ->after('message');

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropIndex(['status']);

            $table->dropColumn([
                'status',
                'note',
            ]);
        });
    }
};
