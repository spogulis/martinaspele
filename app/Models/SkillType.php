<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillType extends Model
{
    use SoftDeletes;

    public function skillLevel(){
        return $this->hasMany(Skill::class);
    }
}
