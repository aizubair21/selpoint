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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->autoIncrement()->index();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('phone')->nullable(); // personal phone
            $table->text('pay_by')->nullable();
            $table->text('pay_to')->nullable();
            $table->text('amount')->nullable();
            $table->boolean('is_rejected')->nullable();
            $table->text('reject_for')->nullable();
            $table->timestamp('seen_by_admin')->nullable();
            $table->boolean('status')->nullable(); // 0 pending, 1 confirmed, 2 rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
