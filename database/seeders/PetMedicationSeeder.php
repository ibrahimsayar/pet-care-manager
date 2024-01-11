<?php

namespace Database\Seeders;

use App\Models\PetMedication;
use Database\Factories\PetMedicationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetMedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetMedication::factory()
            ->count(1)
            ->create();
    }
}
