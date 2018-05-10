<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $table = 'reports';
    protected $fillable = ['title','value'];
    protected $dates = ['deleted_at'];
}