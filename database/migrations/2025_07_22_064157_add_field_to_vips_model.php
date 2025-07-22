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
        Schema::table('vips', function (Blueprint $table) {
            $table->string('reference', 100)->nullable()->default('REF101U');
            $table->string('comission', 100)->nullable()->default(100);
            $table->string('refer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vips', function (Blueprint $table) {
            // drop the columns if exists
            $table->dropColumnIfExists('reference');
            $table->dropColumnIfExists('comission');
            $table->dropColumnIfExists('refer');
        });
    }
};
