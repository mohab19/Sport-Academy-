<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['user_id','place_id','name','description','price','quantity','picture','discount'];
    protected $dates = ['deleted_at'];
    public function incomes()
    {
        return $this->hasMany('App\models\InCome');
    }
    public function outcomes()
    {
        return $this->hasMany('App\models\OutCome');
    }
    public function getSalesTimesAttribute()
    {
        $sales = 0;
       foreach ($this->incomes as $income)
       {
           $sales += $income->quantity;
       }
       return $sales;
    }
    public function getSalesMoneyAttribute()
    {
        $money = 0;
       foreach ($this->incomes as $income)
       {
           $money += $income->value;
       }
       return $money;
    }
    public function getDateAttribute()
    {
        return date("d-m-Y",strtotime($this->created_at));
    }

}
