<?php

namespace Database\Seeders;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups =
        [
            [
                'group' => 'A',
                'grade_id' => Grade::all()->random()->id,
                'level_id' => Level::all()->random()->id,
                'generation_id' => Generation::all()->random()->id,

            ],
            [
                'group' => 'B',
                'grade_id' => Grade::all()->random()->id,
                'level_id' => Level::all()->random()->id,
                'generation_id' => Generation::all()->random()->id,
            ],
            [
                'group' => 'C',
                'grade_id' => Grade::all()->random()->id,
                'level_id' => Level::all()->random()->id,
                'generation_id' => Generation::all()->random()->id,
            ],
        ];


        foreach ($groups as $group) {
            Group::create($group);
        }

    }
}
