<?php

namespace App\Http\Controllers;

use App\models\Comment;
use App\models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function add(Request $request)
    {
        $default_image = asset('images/Users/default.gif');
        $this->validate($request, [
            'body' => 'required',
        ]);
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $comment = Comment::create($data);
        $post_following = Array();
        if($comment)
        {
            $data['sender_id'] = Auth::user()->id;
            $data['post_id'] = $comment->post_id;
            $data["notification_type_id"] = 0;
            if(sizeof($comment->post->comments) == 1 && $comment->user_id != $comment->post->user_id)
            {
                $data["notification_type_id"] = 3;
                $data["user_id"] = $comment->post->user_id;
                Notification::create($data);
            }
            else if(sizeof($comment->post->comments)>0)
            {
                foreach ($comment->post->comments as $item)
                {
                    if($item->user_id != $comment->user_id )
                    {
                        $data["notification_type_id"] = 4;
                        $data["user_id"] = $item->user_id;
                        Notification::create($data);
                        break;
                    }
                }
            }
         return 1;
        }
        else
            return 0;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $comment = Comment::find($request->id);
        $data = $request->except('_token','id');
        if($comment->update($data))
            return 1;
        else
            return 0;

    }
    public function delete(Request $request)
    {
        $comment = Comment::find($request->id);
        if($comment->forcedelete())
            return 1;
        else
            return 0;
    }
}
