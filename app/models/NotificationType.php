<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notifications_types';
    protected $fillable = ['name'];
    public $timestamps = false;
}
