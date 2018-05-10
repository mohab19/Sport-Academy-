@extends('layouts.dashboard')

@section('style')

    <style>
        .news
        {
            text-align: center;
        }
        .news .item
        {
            height:300px;
            width:31%;
            margin:1%;
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            display: inline-block;
        }
        .news .item .image
        {
            height: 200px;
            width: 100%;
        }
        .item .image img
        {
            width:100%;
            height:100%;
        }
        .news .item .caption
        {
            height: 100px;
            width: 100%;
            background: #fff;
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            padding: 10px;
        }
        .news .item .caption p
        {
            height:50px;
            overflow: hidden;
            font-size: 18px;
            text-transform: none !important;
            word-break: break-all;
            text-overflow:ellipsis
        }
    </style>
@endsection

@section('title')
    News
@endsection

@section('tab')

    @include('forms.news.add')
    @include('forms.news.delete')
    <button class="main-button AddNewsButton AddButton" data-popup="add-news-popup">+</button>
    <div class="news">
        @foreach($news as $item)
            <div class="item">
                <div class="image">
                    <img src="{{$item->cover}}">
                </div>
                <div class="caption">
                    <p>{{$item->title}}</p>
                    <div>
                        <a href="/news/{{$item->id}}/{{$item->title}}" class="rose fl-right"><b>Read More >></b></a>
                        <a href="#" class=" DeleteNewsButton fl-left rose " data-id="{{$item->id}}" data-popup="delete-news-popup"><b>Delete</b></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        @endforeach
            <div class="clearfix"></div>
    </div>
@endsection
@section('script')
    <script>
    </script>
    <script src="{{ asset('Ajax/News.js')}}"></script>
@endsection