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
        Schema::table('weight_records', function (Blueprint $table) {
            //
            $table->foreignId('station_id')
            ->after('truck_id')
            ->nullable()->constrained('stations')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weight_records', function (Blueprint $table) {
            //
            $table->dropForeign(['station_id']);
            $table->dropColumn('station_id');
        });
    }
};
