@extends('layouts.dashboard')

@section('style')


@endsection

@section('title')
Subscriptions
@endsection

@section('tab')
    @include("forms.subscriptions.renew")
    <a href="/subscription/add"><button class="main-button AddButton">+</button></a>
    <div role="tabpanel" class="tab-pane text-center active in" id="players"> <!-- Start tab players -->
    <div class="col-md-12"> <!-- search player -->
        <div class="col-xs-12 filter" id="Players-Filter"></div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 box box-lg"> <!-- start players table -->
        <table id="Subscriptions-table" class="table text-center list-view">
            <thead> <!-- main row -->
            <tr class="info">
                @foreach($SubscriptionsFields as $SubscriptionsField)
                <th>{{$SubscriptionsField}}</th>
                @endforeach
                    <th>Options</th>

            </tr>
            </thead> <!-- main row -->
            <tbody>
            @foreach($Subscriptions as $Subscription)
                <tr>
            <td>{{$Subscription->id}}</td>
            <td><a class="purple" href="/player/{{$Subscription->player->id}}/{{$Subscription->player->user->name}}">{{$Subscription->player->user->name}}</a></td>
            <td><a class="purple" href="/coach/{{$Subscription->schedule->schedule->coach->id}}/{{$Subscription->schedule->schedule->coach->user->name}}">{{$Subscription->schedule->schedule->coach->user->short_name}}</a></td>
            <td>{{$Subscription->schedule->schedule->place->name}}</td>
            <td>{{$Subscription->level->name}}</td>
            <td>
                @foreach($Subscription->subscription_extras as $subscription_extra)
                <div>{{$subscription_extra->extra->name}}</div>
                @endforeach
            </td>
            <td>{{$Subscription->start}}</td>
            <td>{{$Subscription->end}}</td>
            <td>{{$Subscription->total}}</td>
            <td>{{$Subscription->discount}}</td>
            <td>{{$Subscription->paid}}</td>
            <td>{{$Subscription->debt}}</td>
            <td>
                @if($Subscription->is_ended == 1)
                <button data-popup="renew-subscription-popup" data-id="{{$Subscription->id}}" class="RenewSubscription main-button sm-button"><i class="fa fa-calendar"></i> </button>
                @endif

            </td>
            </tr>
            @endforeach
            </tbody>
        </table> <!-- table -->
    </div> <!-- end players table -->
    <div class="text-center pagination">

    </div>

</div> <!-- End tab players -->
@endsection
@section('script')

<script src="{{ asset('Ajax/Subscriptions.js')}}"></script>

@endsection
