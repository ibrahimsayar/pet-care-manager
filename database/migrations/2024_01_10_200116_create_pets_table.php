<?php

use App\Constants\ColorConstants;
use App\Constants\GenderConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('code', 255);
            $table->enum('gender', GenderConstants::GENDERS);
            $table->timestamp('birth_date');
            $table->mediumInteger('breed_id');
            $table->enum('color', ColorConstants::COLORS);
            $table->float('weight');
            $table->smallInteger('height');
            $table->integer('house_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pets', function (Blueprint $table) {
            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->foreign('house_id')->references('id')->on('houses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
