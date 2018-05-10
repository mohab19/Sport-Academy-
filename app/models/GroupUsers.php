<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    protected $table = 'groups_users';
    protected $fillable = ['id','group_id','user_id'];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
