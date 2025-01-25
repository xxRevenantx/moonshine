<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Prescolar',
            'Primaria',
            'Secundaria',
        ];

        foreach ($levels as $level) {
            \App\Models\Level::create([
                'level' => $level,
                'slug' => \Illuminate\Support\Str::slug($level),
            ]);
        }
    }
}
