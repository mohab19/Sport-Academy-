<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionsExtras extends Model
{
        use SoftDeletes;
    protected $table = 'subscriptions_extras';
    protected $fillable = ['subscription_id','extra_id'];
        protected $dates = ['deleted_at'];
    public function subscription()
    {
        return $this->belongsTo('App\models\Subscription');
    }
    public function extra()
    {
        return $this->belongsTo('App\models\Extra');
    }
}
