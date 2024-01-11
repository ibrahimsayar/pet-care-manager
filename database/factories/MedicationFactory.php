<?php

namespace Database\Factories;

use App\Constants\AdministrationPeriodConstants;
use App\Models\Medication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medication>
 */
class MedicationFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Medication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'administration_period' => fake()->randomElement(AdministrationPeriodConstants::ADMINISTRATION_PERIODS),
        ];
    }
}
