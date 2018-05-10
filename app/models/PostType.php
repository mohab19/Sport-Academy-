<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $table = 'posts_types';
    protected $fillable = ['id','title'];
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('App\Model\Post');
    }
}
