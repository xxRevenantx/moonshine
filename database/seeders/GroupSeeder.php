<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Group;
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
            ],
            [
                'group' => 'B',
                'grade_id' => Grade::all()->random()->id,
            ],
            [
                'group' => 'C',
                'grade_id' => Grade::all()->random()->id,
            ],
        ];


        foreach ($groups as $group) {
            Group::create($group);
        }

    }
}
