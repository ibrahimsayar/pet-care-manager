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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname');
            $table->string('phone_number', 20);
            $table->enum('gender', \App\Constants\GenderConstants::GENDERS);
            $table->mediumInteger('city_id');
            $table->integer('district_id');
            $table->text('address');
            $table->softDeletes();

            $table->foreign('city_id')->on('cities')->references('id');
            $table->foreign('district_id')->on('districts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('city_id');
            $table->dropColumn('district_id');
            $table->dropColumn('address');
        });
    }
};
