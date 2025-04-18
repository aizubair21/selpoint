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
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            
            $table->string('nid')->nullable();
            $table->string('nid_photo_front')->nullable();
            $table->string('nid_photo_back')->nullable();
            $table->longText('fixed_address')->nullable();
            $table->longText('current_address')->nullable();

            $table->string('area_condition')->nullable();
            $table->string('targeted_area')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riders');
    }
};
