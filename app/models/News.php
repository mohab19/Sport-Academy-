<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title', 'body','cover','pictures'];
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }
}
