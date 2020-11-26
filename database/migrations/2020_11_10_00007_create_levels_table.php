<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('skill_id')->nullable()->constrained('skills');
            $table->foreignId('level_type')->constrained('level_types');
            $table->integer('current_level');
            $table->integer('current_exp');
            $table->integer('exp_to_level_up');
            $table->decimal('exp_increase_ratio');
            $table->date('level_achievement_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
