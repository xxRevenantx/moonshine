<?php

namespace Database\Seeders;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            // PREESCOLAR
            [
                'grade' => 'primero',
                'grade_number' => '1',
                'level_id' => 1,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'segundo',
                'grade_number' => '2',
                'level_id' => 1,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'tercero',
                'grade_number' => '3',
                'level_id' => 1,
                'generation_id' => Generation::all()->random()->id,
            ],
            // PRIMARIA
            [
                'grade' => 'primero',
                'grade_number' => '1',
                'level_id' => 2,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'segundo',
                'grade_number' => '2',
                'level_id' => 2,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'tercero',
                'grade_number' => '3',
                'level_id' => 2,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'cuarto',
                'grade_number' => '4',
                'level_id' => 2,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'quinto',
                'grade_number' => '5',
                'level_id' => 2,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'sexto',
                'grade_number' => '6',
                'level_id' => 2,
                'generation_id' => Generation::all()->random()->id,
            ],
            //SECUNDARIA
            [
                'grade' => 'primero',
                'grade_number' => '1',
                'level_id' => 3,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'segundo',
                'grade_number' => '2',
                'level_id' => 3,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'grade' => 'tercero',
                'grade_number' => '3',
                'level_id' => 3,
                'generation_id' => Generation::all()->random()->id,
            ],
   
            
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
