<?php

namespace Database\Seeders;

use App\Models\Breed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Breed::factory()
            ->count(1)
            ->create();
    }
}
