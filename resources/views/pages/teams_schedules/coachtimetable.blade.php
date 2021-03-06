@extends('layouts.master')

@section('style')
    <style>
        .coach
        {
            display:inline-block;
            margin:5px;
            padding:5px;
            border:1px solid #ddd;
        }
        .coach .text
        {
            font-size:16px;
        }
    </style>
    <style>
        .times
        {
            position: relative;
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
        tbody td
        {
            background: #fff !important;
        }
    </style>

@endsection

@section('title')
    {{$coach_place->coach->user->short_name}}
@endsection

@section('contents')
    @include('forms.teams_schedules.add')
    <div id="private">
        <input type="hidden" name="id" value="{{$coach_place->place->id}}">
    </div>
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Coach : {{$coach_place->coach->user->short_name}}</h5>
            <h5 class="fl-right"><a href="/schedule/place/{{str_replace(' ', '-', $coach_place->place->name)}}">Back To Place Schedules</a> </h5>
        </div>
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="box box-lg col-md-12">
                <div class="text-right">
                    <button class="print main-button">Print</button>
                </div>
                <div class="pdf">
                    <table class="table">
                        <thead>
                        <tr class="info">
                            <th>Day</th>
                            <th>Schedules</th>
                            <th class="ignorepdf">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($days as $day)
                            <tr>
                                <td>{{$day->name}}</td>
                                <td>
                                    @foreach($day->teams_schedules as $schedule)
                                        @if($coach_place->place->id == $schedule->place_id && $coach_place->coach->id == $schedule->coach->id)
                                            <div class="schedule">
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                                <h5 class="rose">{{$schedule->type}}</h5>
                                            @if($schedule->playground)
                                                <h5 class="purple">{{$schedule->playground->title}}</h5>
                                                @endif
                                                <a  class="ignorepdf" href="/team/schedule/{{$schedule->id}}"><i class="fa fa-info"></i></a>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td  class="ignorepdf">
                                <i class="fa fa-plus white AddScheduleButton" data-place="{{$coach_place->place->id}}" data-day="{{$day->id}}" data-popup="add-schedule-popup"></i>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('Ajax/TeamsSchedules.js')}}"></script>
@endsection
