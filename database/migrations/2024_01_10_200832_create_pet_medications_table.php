<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pet_medications', function (Blueprint $table) {
            $table->id();
            $table->integer('pet_id');
            $table->integer('medication_id');
            $table->timestamp('last_administration_date');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pet_medications', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('medication_id')->references('id')->on('medications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_medications');
    }
};
