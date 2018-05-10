<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = ['full_name', 'birthdate', 'address','password',
        'email','phone','home','facebook','picture','paid','total','role_id','username'];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\models\Roles');
    }

    public function coach()
    {
        return $this->hasOne('App\models\Coach');
    }
    public function player()
    {
        return $this->hasOne('App\models\Player');
    }
    public function employee()
    {
        return $this->hasOne('App\models\Employee');
    }
    public function attendances()
    {
        return $this->hasMany('App\models\Attendance')->withTrashed();
    }
    public function absences()
    {
        return $this->hasMany('App\models\Attendance')->where('attend','0')->onlyTrashed();
    }
    public function salaries()
    {
        return $this->hasMany('App\models\OutCome')->where("outcomes_type_id",3)->withTrashed();
    }
    public function penalties()
    {
        return $this->hasMany('App\models\OutCome')->where("outcomes_type_id",4)->withTrashed();
    }
    public function extras()
    {
        return $this->hasMany('App\models\OutCome')->where("outcomes_type_id",5)->withTrashed();
    }
    public function outcomes()
    {
        return $this->hasMany('App\models\OutCome')->withTrashed();
    }
    public function reports()
    {
        return $this->hasMany('App\models\AdminReports');
    }
    public function incomes()
    {
        return $this->hasMany('App\models\InCome')->withTrashed();
    }
    public function attachments()
    {
        return $this->hasMany('App\models\Attachment')->withTrashed();
    }
    public function captain()
    {
        return $this->hasOne('App\models\Coach');
    }
    public function user_groups()
    {
        return $this->hasMany('App\Models\GroupUsers');
    }
    public function groups()
    {
        return $this->hasMany('App\Models\GroupUsers');
    }
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification')->orderBy("id","DESC");
    }
    public function new_notifications()
    {
        return $this->hasMany('App\Models\Notification')->orderBy("id","DESC")->where("read",0);
    }
    public function getBirthAttribute()
    {
        $birthdate = explode(" ",$this->birthdate);
        $birth = $birthdate[0];
        return  date("d-m-Y",strtotime($birth));
    }
    public function getnameAttribute()
    {
        $name = $this->full_name;
        return $name ;
    }
    public function getShortNameAttribute()
    {
        $name_array = explode(' ', $this->full_name,4);
        if(sizeof($name_array) >1)
        {
            if(strtolower($name_array[1]) == "abd")
            $name = $name_array[0]." ".$name_array[1]." ".$name_array[2];
            else
                $name = $name_array[0]." ".$name_array[1];
        }
        else
            $name = $name_array[0];
        return $name;
    }

}
