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

    $generaciones = [
        '2021-2022',
        '2022-2023',
        '2023-2024',
        '2024-2025',
        '2025-2026',
        '2026-2027',
        '2027-2028',
        '2028-2029',
        '2029-2030',
        '2030-2031',
    ];

    foreach ($niveles as $nivel => $cantidadGrados) {
        $nivelModel = Level::create([
            'level' => $nivel,
            'slug' => Str::slug($nivel),
        ]);

        foreach ($generaciones as $generacion) {
            $generationModel = $nivelModel->generation()->create([
                'start_year' => explode('-', $generacion)[0],
                'end_year' => explode('-', $generacion)[1],
                'status' => 'active',
            ]);

            for ($i = 1; $i <= $cantidadGrados; $i++) {
                $grado = $nivelModel->grade()->create([
                    'grade' => "Grado {$i}",
                    'grade_number' => $i,
                    'generation_id' => $generationModel->id, // Agregar el ID de la generación
                ]);

                // Crear 3 grupos por grado como ejemplo
                foreach (['A', 'B', 'C'] as $grupo) {
                    $grado->group()->create([
                        'name' => "Grupo {$grupo}",
                    ]);
                }
            }
        }
    }
}


}
