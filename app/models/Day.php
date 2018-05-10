<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';
    protected $fillable = ['name'];
    public function schedules()
    {
        return $this->hasMany('App\models\Schedule')->orderBy('from');
    }
    public function teams_schedules()
    {
        return $this->hasMany('App\models\TeamSchedule')->orderBy('from');
    }
}
