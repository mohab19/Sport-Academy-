<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;
    protected $table = 'players';
    protected $fillable = ['user_id','level_id','place_id','school','current_rank','best_rank','old_places','duration'];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function subscription()
    {
        return $this->hasOne('App\models\Subscription');
    }
    public function subscriptions()
    {
        return $this->hasMany('App\models\Subscription')->onlyTrashed();
    }
    public function incomes()
    {
        return $this->hasMany('App\models\InCome');
    }
    public function events()
    {
        return $this->hasMany('App\models\Event');
    }
}