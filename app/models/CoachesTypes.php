<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CoachesTypes extends Model
{
    protected $table = 'coaches_types';
    protected $fillable = ['name'];
    public $timestamps = false;
    public function coach()
    {
        return $this->hasMany('App\models\Coach');
    }
}
