@extends('layouts.dashboard')

@section('style')

    <style>
        /*input,textarea*/
        /*{*/
            /*background: #f5f5f5 !important;*/
            /*border: 1px solid #5356a5 !important;*/
            /*border-radius: 3px !important;*/
            /*padding: 10px !important;*/
            /*font-size: 13px !important;*/
            /*margin:0 !important;*/
        /*}*/
        .post
        {
            background: #f3f3f3;
            padding:10px;
            margin-bottom:5px;
            border:1px solid #ddd;
            border-radius: 5px;
        }
        .post .image img
        {
            width:80%;
            height:80%;
            margin: auto;
        }
        .post .attachments img
        {
            cursor: pointer;
        }
        .post .post-head img,
        .comment .comment-head img
        {
            width: 50px;
            height: 50px;
            padding: 4px;
            border-radius: 50%;
            margin-right: 5px;
        }
         .post .post-head
        {
            font-size:15px;
        }

        .post .post-head .icon
        {
            font-size:11px;
            padding:5px;
            color:#ccc;
        }
        .post .post-head .group
        {
            color:#333;
        }

        .post .post-head .date
        {
            font-size: 12px;
            color:  #90949c;

        }
        .dropdown-menu
        {
            min-width: 100px;
            right:0;
            left:auto;
        }
        .post a.dropdown-toggle,
        .comment a.dropdown-toggle
        {
            font-size:18px;
        }
        .post .dropdown-menu>li>a,
        .comment .dropdown-menu>li>a
        {
            font-size:14px;
        }
         .post .post-body
         {
            padding: 10px;
            font-size: 16px;
             width:95%;
             margin:5px auto;
             white-space: nowrap;
             overflow: hidden;
             text-overflow: ellipsis;
         }
        .comment .comment-body
        {
            padding: 10px;
            width: 95%;
            margin: auto;
            font-size: 15px;
         }
        .comment .comment-head .date
        {
            font-size:10px;
            color:#aaa;
        }
        .comment .comment-head img
        {
            width:40px;
            height:40px;
        }
        .comment .comment-head
        {
            font-size:13px;
        }
         .post-comments .actions
         {
             border-top: 1px solid #ddd;
             border-bottom: 1px solid #ddd;
             padding: 5px 10px;
         }
        .post-comments .previous-comments
        {
            background: #eaeaea;
            width: 98.5%;
            margin: 5px auto;
            max-height: 450px;
            overflow-y: scroll;
        }
        .post-comments .previous-comments .comment
        {
            padding: 5px;
            border-bottom: 1px solid #ccc;
            background: #eee;
            margin: 10px;

        }
         .post .interactive i.fa-comments
        {
            /*border-left: 1px solid #eee;*/
        }
        .AddPostButton
        {
            background-color: #5356a5;
            border-radius: 50%;
            padding: 0px;
            font-size: 18px;
            color: #fff;
            position: fixed;
            bottom: 70px;
            right: 50px;
            z-index: 9;
            width: 50px;
            height: 50px;
        }
        /*#AddPost textarea,*/
        /*#UpdatePost textarea*/
        /*{*/
            /*height: 170px;*/
            /*font-size: 18px;*/
            /*padding: 20px;*/
            /*text-indent: 20px;*/
            /*border-radius:80px;*/
        /*}*/
        div.popup
        {
            max-height: 400px;
        }
         .comment .options
        {
            padding-top: 5px;
            padding-right: 0px;
        }
         .post .options button,
         .comment .options button
        {
            border-radius: 50%;
            padding: 0px;
            margin-left: 7px;
            font-size: 12px;
            width: 40px;
            height: 40px;
            margin-bottom: 0;
        }
        div.notifications
        {
            margin: auto;
            background: #f5f5f5;
            padding: 10px;
        }
        div.notification
        {
            background: #f3f3f3;
            padding:5px;
            margin-bottom:5px;
            border:1px solid #ddd;
            border-radius: 5px;
        }
        div.notification img
        {
            margin-right: 5px;
        }
        div.notification.unread
        {
            background: #ddd;
        }
    </style>
@endsection

@section('title')
    Posts
@endsection
@section('posts-tabs')
    <!-- Nav tabs -->
    {{--<ul class="nav nav-tabs" role="tablist">--}}
        {{--<li class="PublicButton active" role="presentation"><a href="#publicPosts"  role="tab" data-toggle="tab">Public</a></li>--}}
        {{--<li class="PrivateButton" role="presentation"><a href="#privatePosts" role="tab" data-toggle="tab">Private</a></li>--}}
        {{--<li class="notifications" style="position: relative" role="presentation"><a style="width: 100%" href="#notifications" role="tab" data-toggle="tab">--}}
                {{--<i class="fa fa-bell"></i> </a>--}}
                {{--<div id="notifications_number" style="position: absolute;top:7px;right:-11px;background: #fff;padding: 1px 5px; border-radius:50px;font-size: 13px;"></div>--}}
        {{--</li>--}}
    {{--</ul>--}}
@endsection

@section('tab')
    @include('layouts.image')
    @include('forms.posts.add')
    @include('forms.posts.edit')
    @include('forms.posts.delete')
    @include('forms.comments.edit')
    @include('forms.comments.delete')

        <!-- Tab panes -->
        {{--<div class="tab-content">--}}
            {{--<div role="tabpanel" class="tab-pane fade in active" id="publicPosts">--}}

    {{--public--}}
            {{--</div>--}}
            {{--<div role="tabpanel" class="tab-pane fade" id="privatePosts">--}}
{{--private--}}
            {{--</div>--}}
            {{--<div role="tabpanel" class="tab-pane fade" id="notifications">--}}
                {{--<div class="notifications">--}}
                {{--@foreach($notifications as $notification)--}}

    {{--@endforeach--}}
            {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}
    {{--@if($user->role_id == 1 || $user->role_id ==3)--}}
    {{--<button class="main-button AddPostButton AddPublicPostButton" data-popup="add-post-popup"><i class="fa fa-plus"></i></button>--}}
    {{--@endif--}}
    {{--<button style="display: none" class="main-button AddPostButton AddPrivatePostButton" data-popup="add-post-popup"><i class="fa fa-plus"></i></button>--}}
    <h3 class="text-center" style="text-transform: none;margin-top: 120px">
<span>
    Come back soon , we will return with our Android & IOS Application
</span>
    </h3>
    <p class="text-center" style="font-size:18px;">- Killing Shot Squash Academy <i class="fa fa-heart purple"></i> -</p>
@endsection
@section('script')
    <script>
        var startFlag = 1;
        var time = 2000;
        $(document).on("click",".options li.dropdown a",function (e) {
            startFlag = 0;
        });
        $("li.PublicButton").click(function(){
            $("#AddPost input[name='post_type_id']").val(1);
//            $("#AddPost div.group").show(1);
            $(".AddPrivatePostButton").hide(1);
            $(".AddPublicPostButton").show(1);

        })
        $("li.PrivateButton").click(function(){
            $("#AddPost input[name='post_type_id']").val(2);
//            $("#AddPost div.group").hide(1);
            $(".AddPublicPostButton").hide(1);
            $(".AddPrivatePostButton").show(1);
        })
        $("#publicPosts .post-comments").remove();
    </script>
{{--    <script src="{{ asset('Ajax/Posts.js')}}"></script>--}}
    <script src="{{ asset('Ajax/Notifications.js')}}"></script>
{{--    <script src="{{ asset('Ajax/Likes.js')}}"></script>--}}
@endsection