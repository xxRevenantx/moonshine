<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Carlos Nuñez',
        //     'email' => 'carlos@admin.com',
        //     'password' => bcrypt('12345678')
        // ]);

          Storage::deleteDirectory('imagenes');
          Storage::makeDirectory('imagenes');


        $this->call([
            SupervisorSeeder::class,
            DirectorSeeder::class,
            LevelSeeder::class,
            GenerationSeeder::class,
            GradeSeeder::class,
            GroupSeeder::class,

        ]);

    }
}
