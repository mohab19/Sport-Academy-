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
</style>
@endsection

@section('title')
    {{$user->full_name}}
@endsection
@if(sizeof($user->player->subscription) == 0)
<div class="background2"></div>
<div id="sign-in-popup" class="popup" style="display: block;padding:100px 20px;top:10%;overflow: visible;">

        <div class="alert alert-danger text-center" style="font-size:22px;margin-bottom:0">
            {{$user->player->subscription}}
            Your Account has been deactivated <br>
            You Need To Purchase Your Subscription <br>
            To Activate It
        </div>
</div>
    @else
@include('layouts.panelheader')
@section('contents')

    <div class="clearfix"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="box box-lg info">
                <h3 class="title rose">Recent Subscription Information</h3>
                    <table class="table">
                        <tbody>
                        <tr class="danger">
                            <td>Level</td>
                            <td>
                                    @if($user->player->subscription)
                                        <label class="text-left rose">{{$user->player->subscription->level->name}}</label>
                                    @endif
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Coach</td>
                            <td>
                                    <label for="" class="rose text-left">{{$user->player->subscription->schedule->schedule->coach->user->name}}</label>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Place</td>
                            <td>
                                    <label for="" class="rose text-left">{{$user->player->subscription->schedule->schedule->place->name}}</label>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Extra</td>
                            <td>
                            @foreach($user->player->subscription->subscription_extras as $subscription_extra)
                                <label class="text-left rose">{{$subscription_extra->extra->name}}</label>
                                <div class="clearfix"></div>
                            @endforeach
                            </td>
            </tr>
                        <tr class="danger">
                            <td>Duration</td>
                            <td><label class="text-left rose">{{$user->player->subscription->start}} -- {{$user->player->subscription->end}} </label></td>
                        </tr>
                        @if($user->player->subscription->debt)
                            <tr class="danger">
                                <td>Debt</td>
                                <td>
                                    <label class="text-left rose">{{$user->player->subscription->debt}}</label>
                                    <div class="alert-danger">Hurry Up And Pay It</div>
                                </td>
                            </tr>
                        @endif
                        <tr class="danger">
                            <td>Schedule</td>
                            <td>
                                <div class="schedules">
                                    @foreach($user->player->subscription->schedules as $schedule)
                                        <div class='schedule text-left'>
                                            <div class='day purple'>Day : <span class='rose'>{{$schedule->schedule->day->name}}</span></div>
                                            <div class='time purple'>Time : <span class='rose'>{{$schedule->schedule->from}} </span> -- <span class='rose'> {{$schedule->schedule->to}}</span></div>
                                            @if($schedule->schedule->playground)
                                            <div class='playground purple'>Day : <span class='rose'>{{$schedule->schedule->playground->title}}</span></div>
                                                @endif
                                        </div>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Team Schedule</td>
                            <td>
                                <div class="schedules">
                                    @foreach($user->player->subscription->teams_schedules as $schedule)
                                                    <div class='schedule text-left'>
                                                            <div class='day purple'>Day : <span class='rose'>{{$schedule->team_schedule->day->name}}</span></div>
                                                            <div class='time purple'>Time : <span class='rose'>{{$schedule->team_schedule->from}} </span> -- <span class='rose'> {{$schedule->team_schedule->to}}</span></div>
                                                            <div class='type purple'><span class='rose'>{{$schedule->team_schedule->type}}</span></div>
                                                    </div>
                                            </label>
                                    @endforeach
                                </div>
                                <label for="" class="alert text-center" id="subscription_schedule"></label>
                            </td>
                        </tr>
            </tbody>
            </table>
        </div>
            <div class="box paying text-center">
                <h3 class="title rose text-left">Products Debts</h3>
                <table class="table text-center">
                    <thead>
                    <tr class="info">
                        <th>Title</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($user->incomes)
                        @foreach($user->incomes as $income)
                            @if($income->debt)
                                <tr class="danger">
                                    <td>{{$income->product->name}}</td>
                                    <td>{{$income->debt}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="text-center pagination">

                </div>
            </div>
        </div>
    </div>

@endsection

@endif