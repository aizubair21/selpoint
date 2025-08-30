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
            $table->string('fixed_amount', 100)->nullable()->default('500');
            $table->string('name', 100)->nullable()->default('Rider Name');
            $table->string('comission', 100)->nullable()->default('10');
            $table->boolean('is_rejected')->nullable()->default(false);
            $table->text('rejected_for')->nullable();
            $table->text('doc_1')->nullable();
            $table->text('doc_2')->nullable();
            $table->text('doc_3')->nullable();
            $table->text('doc_4')->nullable();

            $table->text('country')->nullable()->default('Bangladesh');
            $table->text('district')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riders', function (Blueprint $table) {
            $table->dropColumn([
                'fixed_amount',
                'comission',
                'is_rejected',
                'rejected_for',
                'doc_1',
                'doc_2',
                'doc_3',
                'doc_4',
                'country',
                'district',

            ]);
        });
    }
};
