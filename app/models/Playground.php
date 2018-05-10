<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playground extends Model
{
    use SoftDeletes;
    protected $table = 'playgrounds';
    protected $fillable = ['title', 'notes','place_id'];

    public function place()
    {
        return $this->belongsTo('App\models\Place');
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }
}
