<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeesPlaces extends Model
{
        use SoftDeletes;
    protected $table = 'employees_places';
    protected $fillable = ['employee_id','place_id'];
        protected $dates = ['deleted_at'];
    public function employee()
    {
        return $this->belongsTo('App\models\Employee');
    }
    public function place()
    {
        return $this->belongsTo('App\models\Place');
    }
}
