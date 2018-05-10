<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $fillable = ['name', 'price','max','notes'];

public function player()
    {
        return $this->hasMany('App\models\Player');
    }
    public function subscriptions()
    {
        return $this->hasMany('App\models\Subscription');
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }

}
