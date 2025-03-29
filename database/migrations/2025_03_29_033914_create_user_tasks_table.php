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
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->foreignId('vip_id')->constrained('vips')->onDelete('cascade');
            $table->text('earn_by')->nullable();
            $table->text('task_type')->nullable();
            $table->text('coin')->nullable();
            $table->text('time')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tasks');
    }
};
