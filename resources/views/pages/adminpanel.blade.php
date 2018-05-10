@extends('layouts.dashboard')

@section('style')

@endsection

@section('title')
    Killing Shot - Admin
    @endsection

    @section('tab')
        <div role="tabpanel" class="tab-pane active" id="home">
            <div class="statistics">
                <h3 class="title rose">Statistics</h3>
                <div class="col-md-3 statistics-box">
                    <h4 class="fl-right">{{$players->count()}}</h4>
                    <h4 class="fl-left">Players</h4>
                </div>
                <div class="col-md-3 statistics-box">
                    <h4 class="fl-right">{{$coaches->count()}}</h4>
                    <h4 class="fl-left">Coaches</h4>
                </div>
                <div class="col-md-3 statistics-box">
                        <h4 class="fl-right">{{$levels->count()}}</h4>
                    <h4 class="fl-left">Levels</h4>
                </div>
                <div class="col-md-3 statistics-box">
                    <h4 class="fl-right">{{$places->count()}}</h4>
                    <h4 class="fl-left">Places</h4>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="players box col-md-6">
                <h3 class="title rose">Latest Players</h3>
                @foreach($players->take(6) as $player)
                    <a href="/player/{{$player->id}}/{{$player->user->name}}">
                <div class="col-md-4 col-xs-6 text-center">
                    @if($player->user->picture)
                        <img src="{{$player->user->picture}}">
                    @else
                       <img src="images/Users/default.gif">
                    @endif
                    <h5 class="purple">{{$player->user->short_name}}</h5>
                    <h5 class="gray">{{date_format($player->created_at,"Y-m-d")}}</h5>
                </div>
                    </a>
                @endforeach
            </div>
            <div class="players box col-md-6">
                <h3 class="title rose">Latest Coaches</h3>
                @foreach($coaches->take(6) as $coach)
                    <a href="/coach/{{$coach->id}}/{{$coach->user->name}}">
                <div class="col-md-4 col-xs-6 text-center">
                    @if($coach->picture)
                        <img src="{{$coach->picture}}">
                    @else
                       <img src="images/Users/default.gif">
                    @endif
                    <h5 class="purple">{{$coach->user->short_name}}</h5>
                    <h5 class="gray">{{date_format($coach->created_at,"Y-m-d")}}</h5>
                </div>
                    </a>
                @endforeach
            </div>
            <div class="levels box col-md-6">
                <h3 class="title rose">Latest Levels</h3>
                @foreach($levels->take(6) as $level)
                <div class="col-md-4 col-xs-6 text-center">
                    <h5 class="purple">{{$level->name}}</h5>
                    <h5 class="gray">{{$level->price}}</h5>
                </div>
                @endforeach
            </div>
            <div class="levels box col-md-6">
                <h3 class="title rose">Latest Places</h3>
                @foreach($places->take(6) as $place)
                <div class="col-md-4 col-xs-6 text-center">
                    <h5 class="purple">{{$place->name}}</h5>
                    <h5 class="gray">{{$place->address}}</h5>
                </div>
                @endforeach
            </div>
            <div class="clearfix"></div>
            {{--<div class="players box col-md-12">--}}
                {{--<h3 class="title rose">Latest Subscriptions</h3>--}}
                {{--@foreach($depts_players as $player)--}}
                    {{--<a href="/player/-{{$player->id}}">--}}
                        {{--<div class="col-md-4 col-xs-6 text-center">--}}
                            {{--@if($player->picture)--}}
                                {{--<img src="{{$player->picture}}">--}}
                            {{--@else--}}
                                {{--<img src="images/Users/default.gif">--}}
                            {{--@endif--}}
                            {{--<h5 class="purple">{{$player->full_name.$player->last_name}}</h5>--}}
                            {{--<h5 class="gray">{{$player->total - $player->paid}}</h5>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        </div>
    @endsection
@section('script')

@endsection
