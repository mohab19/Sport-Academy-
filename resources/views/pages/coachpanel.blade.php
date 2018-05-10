@extends('layouts.master')

@section('style')
<style>
    .background2
    {
        width: 100%;
        height: 100%;
        background:#5356a5;
        z-index: 2222;
        opacity: 0.97;
    }
    .schedule
    {
        float:left;
        margin:5px;
        border:2px solid #eee;
        padding: 5px;
    }
    .schedule h4
    {
        font-size:13px;
        margin:0;
        margin-bottom:5px;
    }
    .schedule h5
    {
        font-size:13px;
        font-weight: 700;
        margin:0;
        margin-bottom:5px;
    }
</style>
@endsection

@section('title')
    {{$user->full_name . " " .$user->last_name}}
@endsection
<div class="background2"></div>
@include('layouts.panelheader')
@section('contents')

    <div class="clearfix"></div>
    <div class="content">
        <div class="container-fluid">
            @foreach($user->coach->coach_places as $coach_place)
            <div class="box box-lg col-md-12">
                <h3 class="title rose">Individuales Schedules - {{$coach_place->place->name}}</h3>
                <button class="print main-button">Print Schedule</button>
                <div class="pdf">
                    <table class="table">
                        <thead>
                        <tr class="info">
                            <th>Day</th>
                            <th>Schedules</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($days as $day)
                            @if(sizeof($day->schedules) >0)
                                <tr>
                                <td>{{$day->name}}</td>
                                <td>
                                    @foreach($day->schedules as $schedule)
                                        @if($schedule->coach_id == $user->coach->id)
                                            <div class="schedule">
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                                @if($schedule->playground)
                                                <h5 class="purple">{{$schedule->playground->title}}</h5>
                                                @endif
                                                <h5 class="rose">{{$schedule->place->title}}</h5>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                                @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
            @foreach($user->coach->coach_places as $coach_place)
            <div class="box box-lg col-md-12">
                <h3 class="title rose">Team Schedules - {{$coach_place->place->name}}</h3>
                <button class="print main-button">Print Schedule</button>
                <div class="pdf">
                    <table class="table">
                        <thead>
                        <tr class="info">
                            <th>Day</th>
                            <th>Schedules</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($days as $day)
                            @if(sizeof($day->teams_schedules) >0)
                                <tr>
                                <td>{{$day->name}}</td>
                                <td>
                                    @foreach($day->teams_schedules as $schedule)
                                        @if($schedule->coach_id == $user->coach->id)
                                            <div class="schedule">
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                                @if($schedule->playground)
                                                <h5 class="purple">{{$schedule->playground->title}}</h5>
                                                @endif
                                                <h5 class="rose">{{$schedule->place->title}}</h5>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                                @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
            {{--<div class="box paying">--}}
                {{--<h3 class="title rose">Players</h3>--}}
                {{--<table class="table">--}}
                    {{--<thead>--}}
                    {{--<tr class="info">--}}
                        {{--<th>Player</th>--}}
                        {{--<th>Place</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@foreach($user->coach->schedules as $schedule)--}}
                        {{--<tr class="danger">--}}
                            {{--<td>{{}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        </div>
    </div>

@endsection