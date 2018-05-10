<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoachesPlaces extends Model
{
        use SoftDeletes;
    protected $table = 'coaches_places';
    protected $fillable = ['coach_id','place_id'];
        protected $dates = ['deleted_at'];
    public function coach()
    {
        return $this->belongsTo('App\models\Coach');
    }
    public function place()
    {
        return $this->belongsTo('App\models\Place');
    }
}
