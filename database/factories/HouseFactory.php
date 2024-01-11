<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = House::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = CityFactory::new()
            ->create();

        $district = DistrictFactory::new()
            ->create();

        return [
            'name' => fake()->company,
            'capacity' => fake()->randomNumber(3),
            'status' => fake()->boolean(),
            'city_id' => $city->id,
            'district_id' => $district->id,
        ];
    }
}
