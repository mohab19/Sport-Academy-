<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleTimes extends Model
{
    use SoftDeletes;
    protected $table = 'schedules_times';
    protected $fillable = ['schedule_id','day','from','to'];
    protected $dates = ['deleted_at'];
    public function schedule()
    {
        return $this->belongsTo('App\models\Schedule');
    }
}
