<?php

namespace Database\Factories;

use App\Models\Director;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
        $faker->addProvider(new \Mmo\Faker\LoremSpaceProvider($faker));

        $nombre =  $this->faker->word();
        return [
            'level' => $nombre,
            'slug' => Str::slug($nombre),
            'imagen' => 'imagenes/' . $faker->picsum('public/storage/imagenes', 640, 480, false),
            'color' => $this->faker->hexColor,
            'cct' =>  $this->faker->randomElement(['12PJN0226W', '12PPR0070B', '12PES0105U']),
            'director_id' => Director::all()->random()->id,
            'supervisor_id' => Supervisor::all()->random()->id,

        ];
    }
}
