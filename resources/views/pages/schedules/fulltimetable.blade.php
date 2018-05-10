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
    {{$place->name}}
@endsection

@section('contents')
    <div id="private">
        <input type="hidden" name="id" value="{{$place->id}}">
    </div>
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Place : {{$place->name}}</h5>
            <h5 class="fl-right"><a href="{{\Illuminate\Support\Facades\URL::previous()}}">Back To Place Schedules</a> </h5>
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
                            {{--<th class="ignorepdf">Options</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($days as $day)
                            <tr>
                                <td>{{$day->name}}</td>
                                <td>
                                    @foreach($day->schedules as $schedule)
                                        @if($place->id == $schedule->place_id)
                                            <div class="schedule">
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                                <h5 class="purple">{{$schedule->coach->user->short_name}}</h5>
                                                @if($schedule->playground)
                                                    <h5 class="purple">{{$schedule->playground->title}}</h5>
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
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('Ajax/Schedules.js')}}"></script>
@endsection
