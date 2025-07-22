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
        Schema::table('withdraws', function (Blueprint $table) {
            $table->string('paid_from', 100)->nullable(); // Source of the payment
            $table->string('transaction_id', 100)->nullable(); // Transaction ID

            $table->string('payment_priority', 100)->nullable(); // urgent, normal
            $table->string('currency', 100)->nullable(); // BDT, USD
            $table->string('subscription_plan', 100)->nullable(); // VIP packages
            $table->string('user_role', 100)->nullable(); // user, reseller, vendor
            $table->string('payable_amount', 100)->nullable(); // Amount user receives after deductions
            $table->string('total_fee', 100)->nullable(); // Total deductions (VAT etc.)
            $table->string('fee_range', 100)->nullable(); // Fee range applied
            $table->string('server_fee', 100)->nullable(); // Portion for server
            $table->string('maintenance_fee', 100)->nullable(); // Portion for maintenance

            $table->string('payment_method', 100)->nullable(); // m_cash, cash, bank
            $table->string('bank_account', 100)->nullable(); // Bank account for transfer
            $table->string('account_holder_name', 100)->nullable(); // Name of account holder
            $table->string('bank_branch', 100)->nullable(); // Bank branch
            $table->string('swift_code', 100)->nullable(); // SWIFT code
            $table->string('account_number', 100)->nullable(); // Bank account number

            $table->string('confirmed_by', 100)->nullable(); // Admin who confirmed
            $table->boolean('confirmed')->nullable()->default(false); // 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withdraws', function (Blueprint $table) {
            $table->dropColumnIfExists('paid_from');
            $table->dropColumnIfExists('transaction_id');
            $table->dropColumnIfExists('payment_priority');
            $table->dropColumnIfExists('currency');
            $table->dropColumnIfExists('subscription_plan');
            $table->dropColumnIfExists('user_role');
            $table->dropColumnIfExists('payable_amount');
            $table->dropColumnIfExists('total_fee');
            $table->dropColumnIfExists('fee_range');
            $table->dropColumnIfExists('server_fee');
            $table->dropColumnIfExists('maintenance_fee');
            $table->dropColumnIfExists('payment_method');
            $table->dropColumnIfExists('bank_account');
            $table->dropColumnIfExists('account_holder_name');
            $table->dropColumnIfExists('bank_branch');
            $table->dropColumnIfExists('swift_code');
            $table->dropColumnIfExists('account_number');
            $table->dropColumnIfExists('confirmed_by');
            $table->dropColumnIfExists('confirmed');
        });
    }
};
