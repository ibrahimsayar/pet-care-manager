<?php

use App\Constants\GenderConstants;
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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('phone_number', 20);
            $table->string('email');
            $table->enum('gender', GenderConstants::GENDERS);
            $table->smallInteger('city_id');
            $table->integer('district_id');
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
