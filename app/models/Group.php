<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['id','name','owner_id'];
    public function posts()
    {
        return $this->hasMany('App\Model\Post');
    }
    public function group_users()
    {
        return $this->hasMany(GroupUsers::class);
    }
    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}
