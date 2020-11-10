<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;

    protected $fillable =
    [
        'skill_name',
        'skill_type',
        'skill_description',
        'exp_to_reach',
        'exp_increase_type',
        'exp_increase_ratio',
        'affects_general_level'
    ];

    // public function skillType() {
    //     return $this->hasOne(SkillType::class);
    // }

    // public function skillLevel() {
    //     return $this->hasOne(Level::class);
    // }
}
