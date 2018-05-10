<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $fillable = ['player_id','body'];
    protected $dates = ['deleted_at'];
    public function player()
    {
        return $this->belongsTo('App\models\Player');
    }
}