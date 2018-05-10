<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    protected $table = 'attendances';
    protected $fillable = ['user_id','type','attend','schedule_id','team_schedule_id'];
    protected $dates = ['deleted_at'];
    public function schedule()
    {
        return $this->belongsTo('App\models\Schedule');
    }
    public function team_schedule()
    {
        return $this->belongsTo('App\models\TeamSchedule');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }
}