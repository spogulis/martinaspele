<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iterations = 3;
        $date1 = Carbon::createFromDate(2020, 10, 2);
        $levels = [
            'userIds' => [1, 2, 3],
            'skillIds' => [1, 2, 3],
            'levelTypeIds' => [1, 2, 3],
            'currentLevels' => [1, 5, 10],
            'currentExp' => [50, 75, 125],
            'expToLevelUp' => [150, 125, 75],
            'expIncreaseRatio' => [1, 1.2, 1.5],
            'levelAchievementDate' => [
                $date1,
                Carbon::createFromDate(2020, 10, 3),
                Carbon::createFromDate(2020, 10, 4)
                ]
        ];


        for ($i = 0; $i < $iterations; $i++)
        {
            Level::create([
                'user_id' => $levels['userIds'][$i],
                'skill_id' => $levels['skillIds'][$i],
                'level_type' => $levels['levelTypeIds'][$i],
                'current_level' => $levels['currentLevels'][$i],
                'current_exp' => $levels['currentExp'][$i],
                'exp_to_level_up' => $levels['expToLevelUp'][$i],
                'exp_increase_ratio' => $levels['expIncreaseRatio'][$i],
                'level_achievement_date' => $levels['levelAchievementDate'][$i],
            ]);
        }

        // Level::create([
        //     'user_id' => 1,
        //     'skill_id' => 1,
        //     'level_type' => 0,
        //     'current_level' => 0,
        //     'current_exp' => 0,
        //     'exp_to_level_up' => 200,
        //     'exp_increase_ratio' => 1,
        //     'level_achievement_date' => null
        // ]);

        // Level::create([
        //     'user_id' => 2,
        //     'skill_id' => 2,
        //     'level_type' => 1,
        //     'current_level' => 0,
        //     'current_exp' => 75,
        //     'exp_to_level_up' => 200,
        //     'exp_increase_ratio' => 1.2,
        //     'level_achievement_date' => null
        // ]);

        // Level::create([
        //     'user_id' => 3,
        //     'skill_id' => 2,
        //     'level_type' => 1,
        //     'current_level' => 1,
        //     'current_exp' => 220,
        //     'exp_to_level_up' => 400,
        //     'exp_increase_ratio' => 1.5,
        //     'level_achievement_date' => null
        // ]);
    }
}
