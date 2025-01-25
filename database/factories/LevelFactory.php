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
        $nombre =  $this->faker->word();
        return [
            'level' => $nombre,
            'slug' => Str::slug($nombre),
            'color' => $this->faker->hexColor,
            'cct' =>  $this->faker->randomElement(['12PJN0226W', '12PPR0070B', '12PES0105U']),
            'director_id' => Director::all()->random()->id,
            'supervisor_id' => Supervisor::all()->random()->id,

        ];
    }
}
