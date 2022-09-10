<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            // Non so che altro mettere
            'Radiologia', 'Chirurgia', 'Pediatria', 'Oncologia', 'Neurochirurgia'
        ];

        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }
    }
}
