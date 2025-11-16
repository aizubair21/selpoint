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
        Schema::table('riders', function (Blueprint $table) {
            // 'vehicle_type' => $this->vehicle_type,
            // 'vehicle_number' => $this->vehicle_number,
            // 'vehicle_model' => $this->vehicle_model,
            // 'vehicle_color' => $this->vehicle_color,
            $table->string('city', 155)->nullable();
            $table->string('vehicle_type', 191)->nullable();
            $table->string('vehicle_number', 191)->nullable();
            $table->string('vehicle_model', 191)->nullable();
            $table->string('vehicle_color', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rider', function (Blueprint $table) {
            $table->dropIfExists(
                [
                    'vehicle_type',
                    'vehicle_number',
                    'vehicle_model',
                    'vehicle_color',
                ]
            );
        });
    }
};
