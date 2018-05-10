<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamSchedule extends Model
{
    use SoftDeletes;
    protected $table = 'teams_schedules';
    protected $fillable = ['place_id','playground_id','coach_id','type','day_id','from','to'];
    protected $dates = ['deleted_at'];
    public function place()
    {
        return $this->belongsTo('App\models\Place');
    }
    public function playground()
    {
        return $this->belongsTo('App\models\Playground');
    }
    public function day()
    {
        return $this->belongsTo('App\models\Day');
    }
    public function subscriptions()
    {
        return $this->hasMany('App\models\TeamScheduleSubscriptions');
    }
    public function coach()
    {
        return $this->belongsTo('App\models\Coach');
    }
}