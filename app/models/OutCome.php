<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutCome extends Model
{
    use SoftDeletes;
    protected $table = 'outcomes';
    protected $fillable = ['outcomes_type_id','invoice_num','client_name','subscription_id','player_id','product_id','quantity','coach_id','employee_id','user_id','place_id','title','value'];
    protected $dates = ['deleted_at'];

    public function outcomes_type()
    {
        return $this->belongsTo('App\models\InComesType');
    }
    public function subscription()
    {
        return $this->belongsTo('App\models\Subscription')->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function player()
    {
        return $this->belongsTo('App\models\Player')->withTrashed();
    }
    public function coach()
    {
        return $this->belongsTo('App\models\Coach')->withTrashed();
    }
    public function product()
    {
        return $this->belongsTo('App\models\Product')->withTrashed();
    }
    public function employee()
    {
        return $this->belongsTo('App\models\Employee')->withTrashed();
    }
    public function place()
    {
        return $this->belongsTo('App\models\Place');
    }

    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }

}
