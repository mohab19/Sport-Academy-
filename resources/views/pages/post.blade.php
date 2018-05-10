@extends('layouts.master')

@section('style')

    <style>
        body
        {
            background: #E9EBEE;
        }
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
            background: #fff;
            padding:10px;
            border:1px solid #ddd;
            border-radius: 5px;
            width: 95%;
            margin:10px auto;
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
        .post .attachments img
        {
            cursor: pointer;
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
    </style>
@endsection

@section('title')
    {{$post->body}}
@endsection

@section('contents')
    @include('layouts.image')
    @include('forms.posts.edit')
    @include('forms.posts.delete')
    @include('forms.comments.edit')
    @include('forms.comments.delete')
    <div id="private">
        <input type="hidden" name="id" value="{{$post->id}}">
    </div>
    <section class="header">
        <div class="container">
            <h5 class="fl-left">KillingShot</h5>
            <h5 class="fl-right"><a href="{{URL::route('posts')}}">Back To Posts</a> </h5>
        </div>
    </section>
    <div class="post-container">

    </div>
@endsection
@section('script')
    <script>
        var startFlag = 1;
        var time = 2000;
        $(document).on("click",".options li.dropdown a",function (e) {
            startFlag = 0;
        });
    </script>
    <script src="{{ asset('Ajax/Post.js')}}"></script>
    <script src="{{ asset('Ajax/Comments.js')}}"></script>
{{--    <script src="{{ asset('Ajax/Likes.js')}}"></script>--}}
@endsection