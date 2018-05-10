<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['body','user_id','group_id','post_type_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\models\Comment');
    }
    public function attachments()
    {
        return $this->hasMany('App\models\Attachment');
    }
    public function notifications()
    {
        return $this->hasMany('App\models\Notification');
    }
    public function group()
    {
        return $this->belongsTo('App\models\Group');
    }
    public function post_type()
    {
        return $this->belongsTo('App\models\PostType');
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

}
