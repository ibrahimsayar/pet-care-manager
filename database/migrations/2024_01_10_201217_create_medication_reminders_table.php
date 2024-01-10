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
        Schema::create('medication_reminders', function (Blueprint $table) {
            $table->id();
            $table->integer('pet_id');
            $table->integer('medication_id');
            $table->timestamp('next_administration_date');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('medication_reminders', function (Blueprint $table) {
            $table->foreign('pet_id')->on('pets')->references('id');
            $table->foreign('medication_id')->on('medications')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_reminders');
    }
};
