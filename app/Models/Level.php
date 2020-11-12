<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $fillable =
    [
        'user_id',
        'skill_id',
        'level_type',
        'current_level',
        'current_exp',
        'exp_to_level_up',
        'exp_increase_ratio',
        'level_achievement_date'
    ];

    public function skill(){
        return $this->hasOne(Skill::class);
    }
}
