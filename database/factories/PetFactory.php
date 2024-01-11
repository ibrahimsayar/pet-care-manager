<?php

namespace Database\Factories;

use App\Constants\ColorConstants;
use App\Constants\GenderConstants;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PetFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $breed = BreedFactory::new()
            ->create();

        $house = HouseFactory::new()
            ->create();

        $user = UserFactory::new()
            ->create();

        return [
            'name' => fake()->name(),
            'code' => fake()->uuid(),
            'gender' => fake()->randomElement(GenderConstants::GENDERS),
            'birth_date' => fake()->date('Y-m-d H:i:s'),
            'breed_id' => $breed->id,
            'color' => fake()->randomElement(ColorConstants::COLORS),
            'weight' => fake()->randomFloat(),
            'height' => fake()->randomNumber(2),
            'house_id' => $house->id,
            'user_id' => $user->id,
        ];
    }
}
