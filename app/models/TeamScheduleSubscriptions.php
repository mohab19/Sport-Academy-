<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamScheduleSubscriptions extends Model
{
    use SoftDeletes;
    protected $table = 'teams_schedules_subscriptions';
    protected $fillable = ['team_schedule_id','subscription_id'];
    protected $dates = ['deleted_at'];
    public function team_schedule()
    {
        return $this->belongsTo('App\models\TeamSchedule');
    }
    public function subscription()
    {
        return $this->belongsTo('App\models\Subscription')->withTrashed();
    }
}
