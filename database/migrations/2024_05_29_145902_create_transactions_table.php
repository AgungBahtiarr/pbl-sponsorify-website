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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_event');
            $table->unsignedBigInteger('id_sponsor');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_level')->nullable(true);
            $table->integer('total_fund')->nullable(true);
            $table->text('comment')->nullable(true);
            $table->string('no_rek')->nullable(true);
            $table->string('bank_name')->nullable(true);
            $table->string('account_name')->nullable(true);
            $table->unsignedBigInteger('id_payment_status')->default(1);
            $table->unsignedBigInteger('id_withdraw_status')->default(1);
            $table->dateTime('payment_date')->nullable(true);
            $table->dateTime('withdraw_date')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
