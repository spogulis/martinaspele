<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LevelType;

class LevelTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levelTypes = ['general', 'public-skill', 'private-skill'];

        foreach ($levelTypes as $levelType)
        {
            LevelType::create([
                'type' => $levelType
            ]);
        }
    }
}
