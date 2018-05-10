<?php

namespace App\Http\Controllers;

use App\models\Attachment;
use App\models\Group;
use App\models\Notification;
use App\models\Post;
use App\models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    public $app_url;
    public $photo_directory;
    public $postCounter;

    public function __construct()
    {
        $this->app_url = url()->to('/');
        $this->photo_directory = 'Posts';
        $postCounter = Post::count();
    }

    public function getPrivatePosts()
    {
        $posts = Post::where("post_type_id", 2)->orderBy("id", "DESC")->get();
        $this->getFeed($posts);
    }

    public function getPublicPosts()
    {
        $posts = Post::where("post_type_id", 1)->orderBy("id", "DESC")->get();
        $this->getFeed($posts);
    }
    public function getFeed($posts)
    {
        $default_image = asset('images/Users/default.gif');
        foreach ($posts as $post) {
            $PostFlag = 0;
            if ($post->post_type->title == "Private") {
                if (Auth::user()->role_id == 1 || $post->user_id == Auth::user()->id)
                    $PostFlag = 1;
            } else if (Auth::user()->id == $post->user_id || Auth::user()->role_id == 1)
                $PostFlag = 1;
            else if ($post->post_type->title == "Public") {
                $PostFlag = 0;
                foreach ($post->group->group_users as $group_user) {
                    if ($group_user->user_id == Auth::user()->id)
                        $PostFlag = 1;
                    else
                        $PostFlag = 0;
                }
            }
            if ($PostFlag == 1) {
                $attachmentCounter = 1;
                echo
                "
                <div class='post'>
                 <a href='/post/{$post->id}' class='dark'>
                <div class='post-head'>
                    <span class='user-picture'>";
                if ($post->user->picture)
                    echo "<img src='{$post->user->picture}'>";
                else
                    echo "<img src='$default_image'>";
                echo "
                    </span>
                        <span>
                            <span class='user-name bold'>{$post->user->short_name}</span>
                            <span> posted in </span>
                            <span class='group bold'>{$post->group->name}</span>
                        </span>
                     <span class='fl-right date' style='line-height: 40px'>
                       {$post->date}
                    </span>
                    <div class='clearfix'></div>
                </div>
                <div";
                if (preg_match('/[^A-Za-z0-9]/', strtok($post->body, ' '))) echo " class='post-body arab' dir='rtl'>";
                else
                    echo " class='post-body'>";
                echo "$post->body
                </div></a>
                <div class='attachments'>";
                foreach ($post->attachments as $attachment) {
                    $file_extinsion_3 = substr($attachment->value, -3);
                    $file_extinsion_4 = substr($attachment->value, -4);
                    if ($file_extinsion_3 == "png" || $file_extinsion_3 == "jpg" || $file_extinsion_3 == "gif" || $file_extinsion_4 == "jpeg")
                    {
                        if(sizeof($post->attachments) == 1)
                            echo "<div class='image text-center col-xs-12'><img data-img data-popup='view-image-popup' src='{$attachment->value}'/></div><div class='clearfix'></div>";
                        else
                            echo "<img data-img data-popup='view-image-popup' src='{$attachment->value}' width='250' style='margin-left:25px'/>";
                    }
                    else {
                        echo "<div class='clearfix'></div> <a download href='{$attachment->value}'>Attachment #$attachmentCounter</a>";
                        $attachmentCounter++;
                    }
                }
                echo "
                    <div class='clearfix'></div></div>
                 </div>
            ";
            }
        }
    }

    function RemoveFolder($dir)
    {
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file"))
                $this->RemoveFolder("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }

    public function AddPostAttachments(Request $request, $post_id, $file)
    {
        $success = 0;
        $file_name = '';
        if ($request->picture) {
            if (is_array($request->picture)) {
                $pictures = array();
                $counter = 0;
                foreach ($request->file('picture') as $item) {
                    $counter++;
                    $logo = $item;
                    $upload_to = app_path() . '/../public/images/' . $this->photo_directory . "/" . $post_id;
                    $extension = $logo->getClientOriginalExtension();
                    $file_name = $file . "-" . $counter . ".$extension";
                    $success = $logo->move($upload_to, $file_name);
                    if ($success)
                        $pictures[] = $this->app_url . "/images/" . $this->photo_directory . "/" . $post_id . "/" . $file_name;
                    else
                        return 0;
                }
                $pictures_str = implode("||", $pictures);
                return $pictures_str;
            }
        } else return 0;
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'groups_id' => 'required',
        ]);
        $flag = 0;
        $counter = 0;
        $data = $request->except('_token');
        $first_post = 0;
        $data["group_id"] = null;
        foreach ($request->groups_id as $group_id)
        {
            $counter++;
            $data['user_id'] = Auth::user()->id;
            $data["group_id"] = $group_id;
            $post = Post::create($data);
            $group = Group::find($group_id);
            $data["post_id"] = $post->id;
            $data['sender_id'] = Auth::user()->id;
            if($request->post_type_id == 1)
            {
                $data["notification_type_id"] = 2;
                foreach ($group->group_users as $group_user)
                {
                    if($group_user->user->role_id == 4)
                    {
                        $data['user_id'] = $group_user->user_id;
                        Notification::create($data);
                    }
                }
            }
            else
            {
                $data["notification_type_id"] = 1;
                if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                {
                    if(Auth::user()->id != $group->owner_id)
                    {
                        $data['user_id'] = $group->owner_id;
                        Notification::create($data);
                    }
                    foreach ($group->group_users as $group_user)
                    {
                        if($group_user->user->role_id == 3 || $group_user->user->role_id == 1 )
                        {
                            if($group_user->user->id != Auth::user()->id)
                            {
                                $data['user_id'] = $group_user->user_id;
                                Notification::create($data);
                            }

                        }
                    }
                }
                else
                {
                    $data['user_id'] = $group->owner_id;
                    Notification::create($data);
                foreach ($group->group_users as $group_user)
                {
                    if($group_user->user->role_id == 3 || $group_user->user->role_id == 1 )
                    {
                        $data['user_id'] = $group_user->user_id;
                        Notification::create($data);
                    }
                }
            }

        }


        if($counter == 1)
            $first_post = $post;
        if ($post) {
            if($counter == 1)
            {
                if ($request->picture[0] != "" && $request->picture[0] != " " && $request->picture[0] != "0") {
                    $attachments = $this->AddPostAttachments($request, $post->id, $post->id);
                    $attachmentsArray = explode("||", $attachments);
                    foreach ($attachmentsArray as $item) {
                        $data["user_id"] = null;
                        $data["post_id"] = $post->id;
                        $data["value"] = $item;
                        Attachment::create($data);
                    }
                }
                $flag =  1;
            }
            if($counter>1 && $first_post)
            {
                foreach ($first_post->attachments as $attachment)
                {
                    $data["user_id"] = null;
                    $data["post_id"] = $post->id;
                    $data["value"] = $attachment->value;
                    Attachment::create($data);
                }
            }
        }
        else
            $flag =  0;
    }
return $flag;
}

public function update(Request $request)
{
    $this->validate($request, [
        'body' => 'required',
    ]);
    $post = Post::find($request->id);
    $data = $request->except('_token', 'id');
    if ($post->update($data))
        return 1;
    else
        return 0;

}

public function delete(Request $request)
{
    $post = Post::find($request->id);
    if (sizeof($post->comments) > 0) {
        foreach ($post->comments as $comment) {
            $comment->forcedelete();
        }
    }
    if (sizeof($post->notifications) > 0) {
        foreach ($post->notifications as $notification) {
            $notification->forcedelete();
        }
    }
    if (sizeof($post->attachments) > 0) {
        $upload_to = app_path() . '/../public/images/' . $this->photo_directory . "/" . $post->id;
        if (is_dir($upload_to))
            $this->RemoveFolder($upload_to);
        foreach ($post->attachments as $attachment) {
            $attachment->forcedelete();
        }
    }

    if ($post->forcedelete())
        return 1;
    else
        return 0;
}

public function Profile($id)
{
    $post = Post::find($id);
    if ($post) {
        return view('pages.post',
            [
                'post' => $post,
                'sponsors' => Sponsor::get()
            ]);
    } else
        return view('errors.404');
}

public function getFeedPost($id)
{
    $post = Post::find($id);
    $default_image = asset('images/Users/default.gif');
    $PostFlag = 0;
    if ($post->post_type->title == "Private") {
        if (Auth::user()->role_id == 1 || $post->user_id == Auth::user()->id)
            $PostFlag = 1;
    } else if ($post->post_type->title == "Public") {
        $PostFlag = 0;
        foreach ($post->group->group_users as $group_user) {
            if ($group_user->user_id == Auth::user()->id)
                $PostFlag = 1;
            else
                $PostFlag = 0;
        }
    }
    if (Auth::user()->id == $post->user_id || Auth::user()->role_id == 1)
        $PostFlag = 1;
    if ($PostFlag == 1) {
        $attachmentCounter = 1;
        echo
        "
                            <div class='post'>
                <div class='post-head'>
                    <div class='fl-left'>
                    <div class='user-picture fl-left'>";
        if ($post->user->picture)
            echo "<img src='{$post->user->picture}'>";
        else
            echo "<img src='$default_image'>";
        echo "
                    </div>
                        <div class='fl-left' style='margin-top:6px;'>
                            <span class='user-name purple'>{$post->user->short_name}</span>
                            <span class='icon'><i class='fa fa-forward'></i></span>
                            <span class='group'>{$post->group->name}</span>
                            <div class='date'>
                                {$post->date}
                            </div>
                        </div>
                        <div class='clearfix'></div>
                    </div>";
        if($post->user->id == Auth::user()->id)
            echo"
                    <div class='fl-right options'>
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle dark-gray' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><i class='fa fa-angle-down'></i></a>
                            <ul class='dropdown-menu'>
                                <li class='pointer UpdatePostButton' data-id='{$post->id}' data-popup='update-post-popup'><a>Update</a></li>
                                <li class='pointer DeletePostButton' data-id='{$post->id}' data-popup='delete-post-popup'><a>Delete</a></li>
                            </ul>
                        </li>
                    </div>";
        echo"
                    <div class='clearfix'></div>
                </div>
                <div";
        if (preg_match('/[^A-Za-z0-9]/', strtok($post->body, ' '))) echo " dir='rtl' class='post-body arab'>";
        else
            echo " class='post-body'>";
        echo "$post->body
                </div>
                <div class='attachments'>";
        foreach ($post->attachments as $attachment) {
            $file_extinsion_3 = substr($attachment->value, -3);
            $file_extinsion_4 = substr($attachment->value, -4);
            if ($file_extinsion_3 == "png" || $file_extinsion_3 == "jpg" || $file_extinsion_3 == "gif" || $file_extinsion_4 == "jpeg") {
                if (sizeof($post->attachments) == 1)
                    echo "<div class='image text-center col-xs-12'><img data-img data-popup='view-image-popup' src='{$attachment->value}'/></div><div class='clearfix'></div>";
                else
                    echo "<img data-img data-popup='view-image-popup' src='{$attachment->value}' width='250' style='margin-left:25px'/>";
            } else {
                echo "<div class='clearfix'></div> <a download href='{$attachment->value}'>Attachment #$attachmentCounter</a>";
                $attachmentCounter++;
            }
        }
        echo "</div>";
        if ($post->post_type->title == "Private")
        {
            echo "
                <div class='post-comments'>
                    <div class='previous-comments'>
                            <div class='actions '>
                                Previous Comments
                                <div class='info fl-right'>
                                    <span class='badge'>{$post->comments->count()}</span>
                                </div>
                                <div class='clearfix'></div>
                            </div>";
            foreach ($post->comments as $comment) {
                echo
                "
            <div class='comment'>
                                    <div class='comment-head'>
                                        <div class='fl-left'>
                                            <div class='user-picture fl-left'>";
                if ($comment->user->picture)
                    echo "<img src='{$comment->user->picture}'>";
                else
                    echo "<img src='$default_image'>";
                echo "</div>
                                            <div class='fl-left' style='margin-top:6px;'>
                                                <span class='user-name purple'>{$comment->user->short_name}</span>
                                                <div class='date'>
                                                    $comment->date
                                                </div>
                                            </div>
                                            <div class='clearfix'></div>
                                        </div>";
                if($comment->user->id == Auth::user()->id)
                    echo"
                                        <div class='fl-right options'>
                                            <li class='dropdown'>
                                                <a href='#' class='dropdown-toggle dark-gray' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><i class='fa fa-angle-down'></i></a>
                                                <ul class='dropdown-menu'>
                                                    <li class='pointer UpdateCommentButton' data-id='$comment->id' data-popup='update-comment-popup'><a>Update</a></li>
                                                    <li class='pointer DeleteCommentButton' data-id='$comment->id' data-popup='delete-comment-popup'><a>Delete</a></li>
                                                </ul>
                                            </li>
                                        </div>";
                echo"
                                        <div class='clearfix'></div>
                                    </div>
                                    <div";
                if (preg_match('/[^A-Za-z0-9]/', strtok($comment->body, ' ')))
                    echo " dir='rtl' class='arab comment-body'>";
                else
                    echo " class='comment-body'>";
                echo "$comment->body
                                    </div>
                                </div>";
            }
            echo " </div>
                        <div class='actions purple'>
                            <form class='AddComment' method='POST' action=''>
                                <input type='hidden' name='post_id' value='{$post->id}'>";
            echo csrf_field();
            echo "<div class='col-xs-12'>
                                    <input placeholder='Comment...' name='body' autocomplete='off'>
                                    <label class='alert' id='Comment_body'></label>
                                </div>
                                <div class='clearfix'></div>
                            </form>
                        </div>
                    </div>
                </div>
            ";
        }
    }
}
}
