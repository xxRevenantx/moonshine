<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveles = [
            'Preescolar' => 3,
            'Primaria' => 6,
            'Secundaria' => 3,
        ];

        foreach ($niveles as $nivel => $cantidadGrados) {
            $nivelModel = Level::create([
                'level' => $nivel,
                'slug' => Str::slug($nivel),
            ]);

            for ($i = 1; $i <= $cantidadGrados; $i++) {
                $grado = $nivelModel->grades()->create([
                    'grade' => "Grado {$i}",
                    'grade_number' => $i

                ]);

                // Crear 3 grupos por grado como ejemplo
                foreach (['A', 'B', 'C'] as $grupo) {
                    $grado->groups()->create([
                        'group' => "{$grupo}"
                    ]);
                }
            }
        }

   
    }

}
