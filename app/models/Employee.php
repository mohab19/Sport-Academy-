<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';
    protected $fillable = ['user_id', 'salary'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function employee_places()
    {
        return $this->hasMany('App\models\EmployeesPlaces');
    }
    public function outcomes()
    {
        return $this->hasMany('App\models\OutCome');
    }

    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }
    public function getnameAttribute()
    {
        return $this->user->full_name;
    }
}
