<?php

namespace Database\Factories;

use App\Models\MedicationReminder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicationReminder>
 */
class MedicationReminderFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = MedicationReminder::class;

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
            'next_administration_date' => Carbon::now()->addWeek(),
        ];
    }
}
