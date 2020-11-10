<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
            'skill_name' => 'Meditation',
            'skill_type' => 1,
            'skill_description' => 'blahblahblah',
            'exp_to_reach' => 200,
            'exp_increase_type' => 'minutes',
            'exp_increase_ratio' => 1,
            'affects_general_level' => false
        ]);

        Skill::create([
            'skill_name' => 'Clairvoyance',
            'skill_type' => 2,
            'skill_description' => 'blahblahblah2',
            'exp_to_reach' => 200,
            'exp_increase_type' => 'minutes',
            'exp_increase_ratio' => 1.2,
            'affects_general_level' => false
        ]);

        Skill::create([
            'skill_name' => 'Awareness',
            'skill_type' => 3,
            'skill_description' => 'blahblahblah',
            'exp_to_reach' => 300,
            'exp_increase_type' => 'times',
            'exp_increase_ratio' => 1.1,
            'affects_general_level' => true
        ]);
    }
}
