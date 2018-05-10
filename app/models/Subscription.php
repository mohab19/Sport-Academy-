<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;
    protected $table = 'subscriptions';
    protected $fillable = ['user_id','player_id','level_id','place_id','total','discount','paid'];
    protected $dates = ['deleted_at'];
    public function level()
    {
        return $this->belongsTo('App\models\Level');
    }
    public function subscription_extras()
    {
        return $this->hasMany('App\models\SubscriptionsExtras');
    }
    public function player()
    {
        return $this->belongsTo('App\models\Player')->withTrashed();
    }
    public function incomes()
    {
        return $this->hasMany('App\models\InCome');
    }
    public function schedules()
    {
        return $this->hasMany('App\models\ScheduleSubscriptions');
    }
    public function teams_schedules()
    {
        return $this->hasMany('App\models\TeamScheduleSubscriptions');
    }
    public function schedule()
    {
        return $this->hasOne('App\models\ScheduleSubscriptions');
    }
    public function getstartAttribute()
    {
        return  date("d-m-Y", strtotime($this->created_at));
    }
    public function getendAttribute()
    {
        return  date("d-m-Y", strtotime("+1 month", strtotime($this->created_at)));
    }
    public function getisEndedAttribute()
    {
        if(strtotime($this->end)<=strtotime(date("d-m-Y")))
            return 1;
        else
            return 0;
    }
    public function getdebtAttribute()
    {
        $debt = $this->total - ($this->discount + $this->paid);
        return $debt;
    }
}