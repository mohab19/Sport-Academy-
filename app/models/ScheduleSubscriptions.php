<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleSubscriptions extends Model
{
    use SoftDeletes;
    protected $table = 'schedules_subscriptions';
    protected $fillable = ['schedule_id','subscription_id'];
    protected $dates = ['deleted_at'];
    public function schedule()
    {
        return $this->belongsTo('App\models\Schedule');
    }
    public function subscription()
    {
        return $this->belongsTo('App\models\Subscription')->withTrashed();
    }
}
