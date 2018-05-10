@extends('layouts.master')

@section('style')
    <style>
        .image
        {
            height:400px;
        }
        .carousel
        {
            width:100% !important;
            height:100% !important;
        }
         .image img
        {
            width:100%;
            height:100%;
        }
        hr
        {
            border-top:1px solid #ccc !important;
        }
        .well
        {
            line-height: 1.7;
            color:#888;
        }
        .carousel-indicators
        {
            display: none !important;
        }
        .carousel-inner
        {
            height:500px;
        }
        .carousel-inner .item
        {
            height: 100% !important;
        }
        #carousel-example-generic
        {
            height: 100% !important;
        }
        .carousel-inner>.item>a>img, .carousel-inner>.item>img
        {
            height: 100% !important;
            width:100%;
        }
    </style>

@endsection

@section('title')
    {{$news->title}}
@endsection

@section('contents')
    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
    <section class="header">
        <div class="container">
            <h5 class="fl-left">News : {{$news->title}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('news')}}">Back To News</a> </h5>
        </div>
    </section>
    @endif
    <div class="content">
        <div class="container-fluid">
            <div class="image">
                <img src="{{$news->cover}}" alt="">
            </div>
            <h3 class="purple">{{$news->title}}</h3>
            <h5 style="margin:10px 50px" class="light text-right">Date : {{$news->date}}</h5>
            <hr>
            <br>
            <div class="well well-lg grey">{{$news->body}}</div>
            @if($news->pictures)
                <div class="col-xs-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="{{$news->cover}}" alt="...">
                            </div>
                            <?php $photos = explode("||",$news->pictures) ?>

                            @foreach($photos as $photo)
                                <div class="item">
                                    <img src="{{$photo}}" alt="...">
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('script')
@endsection
