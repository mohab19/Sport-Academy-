<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InCome extends Model
{
    use SoftDeletes;
    protected $table = 'incomes';
    protected $fillable = ['incomes_type_id','user_id','invoice_id','client_name','receiver_id','player_id','subscription_id','product_id','place_id','title','value','discount','quantity','price_per_unit'];
    protected $dates = ['deleted_at'];

    public function incomes_type()
    {
        return $this->belongsTo('App\models\InComesType');
    }
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function receiver()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function player()
    {
        return $this->belongsTo('App\models\Player')->withTrashed();
    }
    public function subscription()
    {
        return $this->belongsTo('App\models\Subscription')->withTrashed();
    }

    public function coach()
    {
        return $this->belongsTo('App\models\Coach')->withTrashed();
    }
    public function product()
    {
        return $this->belongsTo('App\models\Product')->withTrashed();
    }
    public function place()
    {
        return $this->belongsTo('App\models\Place');
    }
    public function getTotalAttribute()
    {
        return $this->price_per_unit * $this->quantity;
    }
    public function getTotalSubscriptionAttribute()
    {
        return $this->subscription->total;
    }
    public function getDebtAttribute()
    {
        $debts = 0;
//        foreach ($this->deoon as $debt)
//        {
//            $debts +=$debt->value;
//        }
        return ($this->total-$this->value-$this->discount)-$debts;
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }
}
