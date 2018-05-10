<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extras';
    protected $fillable = ['name', 'price'];

    public function player()
    {
        return $this->hasMany('App\models\Players');
    }
    public function subscriptions()
    {
        return $this->hasMany('App\models\Subscriptions');
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }

}
