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
        Schema::create('benefit_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_event');
            $table->string('level');
            $table->integer('slot');
            $table->integer('fund');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit_levels');
    }
};
