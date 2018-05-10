<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['user_id','sender_id','group_id','post_id','notification_type_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function sender()
    {
        return $this->belongsTo('App\User');
    }
    public function group()
    {
        return $this->belongsTo('App\models\Group');
    }
    public function post()
    {
        return $this->belongsTo('App\models\Post');
    }
    public function notification_type()
    {
        return $this->belongsTo('App\models\NotificationType');
    }
    private  function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    public function getDateAttribute()
    {

        $data = $this->time_elapsed_string($this->created_at);
        return $data;
    }
    public function getUrlAttribute()
    {
        return "/post/".$this->post_id;
    }
    public function getTitleAttribute()
    {
        $title = "";
        switch ($this->notification_type_id)
        {
            case 1:
                $title = " added a new private post";
                break;
            case 2:
                $title = " posted in {$this->group->name}";
                break;
            case 3:
                $title = " commented on your post";
                break;
            case 4:
                $title = " also commented on a post you following";
                break;
        }
        return $title;
    }
}
