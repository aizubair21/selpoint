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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            // 'user_id',
            // 'shop_name',
            // 'district',
            // 'address',
            // 'nid',
            // 'nid_front',
            // 'nid_back',
            // 'shop_address',
            // 'shop_phone',
            // 'shop_email',
            // 'shop_license',
            // 'shop_license_front',
            // 'shop_license_back',
            // 'shop_license_tin',
            // 'shop_license_tin_front',
            // 'shop_license_tin_back',

            // 'system_get_comission',
            // 'information_update_date',

            // 'status',
            // 

            $table->bigInteger('user_id')->nullable();
            $table->string('shop_name', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('nid', 20)->nullable();
            $table->text('nid_front')->nullable();
            $table->text('nid_back')->nullable();
            $table->string('shop_address', 500)->nullable();
            $table->string('shop_phone', 20)->nullable();
            $table->string('shop_email', 100)->nullable();
            $table->string('shop_license', 100)->nullable();
            $table->text('shop_license_front')->nullable();
            $table->text('shop_license_back')->nullable();
            $table->string('shop_license_tin', 100)->nullable();
            $table->text('shop_license_tin_front')->nullable();
            $table->text('shop_license_tin_back')->nullable();
            $table->text('system_get_comission')->nullable();
            $table->timestamp('information_update_date')->nullable();
            $table->string('status')->nullable()->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
