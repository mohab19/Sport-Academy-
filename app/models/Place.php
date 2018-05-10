<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;
    protected $table = 'places';
    protected $fillable = ['name','price', 'address','map'];

    public function player()
    {
        return $this->hasMany('App\models\Player');
    }
    public function schedules()
    {
        return $this->hasMany('App\models\Schedule')->orderBy('from');
    }
    public function playgrounds()
    {
        return $this->hasMany('App\models\Playground');
    }
    public function coaches_places()
    {
        return $this->hasMany('App\models\CoachesPlaces');
    }
    public function employees_places()
    {
        return $this->hasMany('App\models\EmployeesPlaces');
    }
    public function subscriptions()
    {
        return $this->hasMany('App\models\Subscription');
    }
    public function outcomes()
    {
        return $this->hasMany('App\models\OutCome');
    }
    public function incomes()
    {
        return $this->hasMany('App\models\InCome');
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }

}
