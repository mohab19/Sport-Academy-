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
    <div id="private">
        <input type="hidden" name="id" value="{{$place->id}}">
    </div>
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Place : {{$place->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('schedules')}}">Back To Schedules</a> </h5>
        </div>
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="box box-lg info">
                <h3 class="title rose">Coaches</h3>
                    <div class="coaches">
                        @foreach($place->coaches_places as $coach_place)
                            <a href="/schedule/place/coach/{{$coach_place->id}}/timetable">
                                <div class="coach">
                                <div class=" text-center">
                                    <img width="120" height="120" src="@if($coach_place->coach->user->picture){{$coach_place->coach->user->picture}}@else  {{ asset('images/Users/default.gif')}}  @endif">
                                </div>
                                <div class="text text-center dark-gray">
                                    {{$coach_place->coach->user->short_name}}
                                </div>
                            </div>
                            </a>
                        @endforeach
                    </div>
            </div>
            <div class="box box-lg info">
                <h3 class="title rose">Empty Schedules</h3>
                <div class="col-md-6">
                    <input type="text" id="SearchScheduleCourtInput" placeholder="Search By Court ">
                </div>
                <div class="col-md-6">
                    <input type="text" id="SearchScheduleCoachInput" placeholder="Search By Coach ">
                </div>
                <table class="table">
                    <thead>
                    <tr class="info">
                        <th>Day</th>
                        <th>Schedules</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($days as $day)
                        <tr>
                            <td>{{$day->name}}</td>
                            <td>
                                @foreach($day->schedules as $schedule)
                                    @if($place->id == $schedule->place_id && sizeof($schedule->subscriptions)==0)
                                        <div class="schedule">
                                            <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                            <h5 class="purple">{{$schedule->coach->user->short_name}}</h5>
                                            @if($schedule->playground)
                                                <h4 class="purple">{{$schedule->playground->title}}</h4>
                                            @endif
                                            <a  class="ignorepdf" href="/schedule/{{$schedule->id}}"><i class="fa fa-info"></i></a>
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            {{--<td  class="ignorepdf">--}}
                            {{--<i class="fa fa-plus white AddScheduleButton" data-place="{{$place->id}}" data-day="{{$day->id}}" data-popup="add-schedule-popup"></i>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <a href="/schedule/place/{{$place->id}}/fulltimetable"><button class="main-button">Generate FullTimeTable</button></a>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('Ajax/Schedules.js')}}"></script>
    <script>
        $("#SearchScheduleCourtInput").keyup(function(){

            var filter = $(this).val();
            $(".schedule h4").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().hide(400);
                } else {
                    $(this).parent().show(400);
                }
            });
        });
        $("#SearchScheduleCoachInput").keyup(function(){

            var filter = $(this).val();
            $(".schedule h5").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().hide(400);
                } else {
                    $(this).parent().show(400);
                }
            });
        });
    </script>
@endsection
