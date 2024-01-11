<?php

namespace Database\Seeders;

use App\Models\MedicationReminder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicationReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicationReminder::factory()
            ->count(1)
            ->create();
    }
}
