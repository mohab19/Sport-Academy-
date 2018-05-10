<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoachesLevels extends Model
{
        use SoftDeletes;
    protected $table = 'coaches_levels';
    protected $fillable = ['coach_id','level_id'];
        protected $dates = ['deleted_at'];
    public function coach()
    {
        return $this->belongsTo('App\models\Coach');
    }
    public function level()
    {
        return $this->belongsTo('App\models\Level');
    }
}
