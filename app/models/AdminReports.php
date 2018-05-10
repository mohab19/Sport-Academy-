<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminReports extends Model
{
    use SoftDeletes;
    protected $table = 'admins_reports';
    protected $fillable = ['user_id','report_id'];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function report()
    {
        return $this->belongsTo('App\models\Report');
    }
}