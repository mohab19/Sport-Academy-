<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use SoftDeletes;
    protected $table = 'debts';
    protected $fillable = ['income_id','invoice_id','receiver_id','title','value'];
    protected $dates = ['deleted_at'];
    public function income()
    {
        return $this->belongsTo('App\models\InCome');
    }
    public function invoice()
    {
        return $this->belongsTo('App\models\Invoice');
    }
        public function receiver()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }

}
