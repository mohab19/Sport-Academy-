<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id','name', 'description'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
