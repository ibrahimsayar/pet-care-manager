<?php

namespace Database\Factories;

use App\Models\PetMedication;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetMedication>
 */
class PetMedicationFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = PetMedication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pet = PetFactory::new()
            ->create();

        $medication = MedicationFactory::new()
            ->create();

        return [
            'pet_id' => $pet->id,
            'medication_id' => $medication->id,
            'last_administration_date' => Carbon::now()->subWeek(),
        ];
    }
}
