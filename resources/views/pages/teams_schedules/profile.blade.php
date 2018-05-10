@extends('layouts.master')

@section('style')
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
    {{$place->name}}
@endsection

@section('contents')
    @include('forms.teams_schedules.add')
    <div id="private">
        <input type="hidden" name="id" value="{{$place->id}}">
    </div>
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Place : {{$place->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('teams_schedules')}}">Back To Schedules</a> </h5>
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
                                        @if($schedule->place->id == $place->id)
                                            <div class="schedule">
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                                <h5 class="rose">{{$schedule->type}}</h5>
                                                <a  class="ignorepdf" href="/team/schedule/{{$schedule->id}}"><i class="fa fa-info"></i></a>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td  class="ignorepdf">
                                    <i class="fa fa-plus white AddScheduleButton" data-day="{{$day->id}}" data-popup="add-schedule-popup"></i>
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
