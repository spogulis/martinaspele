<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SkillType;

class SkillTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SkillType::create([
            'type' => 'Type1',
            'description' => 'Type 1 does the following...'
        ]);

        SkillType::create([
            'type' => 'Type2',
            'description' => 'Type 2 does the following...'
        ]);

        SkillType::create([
            'type' => 'Type3',
            'description' => 'Type 3 does the following...'
        ]);
    }
}
