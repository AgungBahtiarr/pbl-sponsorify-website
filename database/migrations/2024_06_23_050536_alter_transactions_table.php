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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('id_event')->references('id')->on('events');
            $table->foreign('id_sponsor')->references('id')->on('sponsors');
            $table->foreign('id_status')->references('id')->on('statuses');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_payment_status')->references('id')->on('payment_statuses');
            $table->foreign('id_withdraw_status')->references('id')->on('withdraw_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
