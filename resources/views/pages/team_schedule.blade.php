@extends('layouts.master')

@section('style')

    <style>
        .times
        {
            position: relative;
        }
    </style>
@endsection

@section('title')
    Schedule
@endsection

@section('contents')
    @include('forms.teams_schedules.delete')

    <section class="header">
        <div class="container">
            <h5 class="fl-left">Schedule</h5>
            <h5 class="fl-right white pointer"  onclick="back()">Back To Schedules </h5>
        </div>
    </section>
    <div id="private">
        <input type="hidden" id="ScheduleID" value="{{$schedule->id}}">
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="box box-lg info">
                <h3 class="title rose">Info</h3>
                @include('forms.teams_schedules.update')
            </div>
            <div class="box text-center">
                <h3 class="title rose text-left">Players</h3>
                <table id="penalties-table" class="table text-center list-view">
                    <thead>
                    <tr class="info">
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schedule->subscriptions as $schedule_subscription)
                                <tr class="danger">
                                    <td>
                                        <a style="color:#5356a5 !important" href="/player/{{$schedule_subscription->subscription->player->id}}/{{$schedule_subscription->subscription->player->user->name}}">
                                        {{$schedule_subscription->subscription->player->user->name}}
                                        </a>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <div class="clearfix"></div>
    <div class="text-center">
        <button class="main-button" data-popup="delete-schedule-popup">Delete Schedule</button>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('Ajax/TeamSchedule.js')}}"></script>
@endsection
