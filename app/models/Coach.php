<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coach extends Model
{
    use SoftDeletes;
    protected $table = 'coaches';
    protected $fillable = ['user_id', 'salary','type_id','schedules_id'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function players()
    {
        return $this->hasMany('App\models\Player');
    }
    public function schedules()
    {
        return $this->hasMany('App\models\Schedule')->orderBy('from');
    }
    public function teams_schedules()
    {
        return $this->hasMany('App\models\TeamSchedule');
    }
    public function coach_places()
    {
        return $this->hasMany('App\models\CoachesPlaces');
    }
    public function coach_levels()
    {
        return $this->hasMany('App\models\CoachesLevels');
    }
    public function outcomes()
    {
        return $this->hasMany('App\models\OutCome');
    }
    public function type()
    {
        return $this->belongsTo('App\models\CoachesTypes');
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }
    public function getnameAttribute()
    {
        $name = $this->user->full_name;
        return $name ;
    }
}
