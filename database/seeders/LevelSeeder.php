<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = Level::factory(3)->create();

        $levels->each(function ($level) {
            Image::factory(1)->create([
                'imageable_id' => $level->id,
                'imageable_type' => Level::class
            ]);
        });



    }

}
