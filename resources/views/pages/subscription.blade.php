@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

@endsection

@section('title')
    Subscriptions
@endsection

@section('tab')
    <!-- Start Add Player form -->
    <div id="add-subscription-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content"> <!-- start popup-content -->
            <form id="AddSubscription" enctype="multipart/form-data" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-6"> <!-- place -->
                    <select name="player_id">>
                        <option value="">Choose Player</option>
                        @foreach($Players as $Player)
                            <option value="{{$Player->id}}">{{$Player->user->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="player_id"></label>
                </div>
                <div class="col-md-6"> <!-- level -->
                    <select name="level_id">
                        <option value="">Choose Level</option>
                        @foreach($Levels as $Level)
                            <option value="{{$Level->id}}">{{$Level->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="level_id"></label>
                </div>
                <div class="col-md-6"> <!-- place -->
                    <select name="place_id">>
                        <option value="">Choose Place</option>
                        @foreach($Places as $Place)
                            <option value="{{$Place->id}}">{{$Place->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="place_id"></label>
                </div>
                <div class="col-md-6"> <!-- squash association -->
                    <select name="coach_id">
                        <option value="">Choose Coach</option>
                        @foreach($Coaches as $Coach)
                            <option value="{{$Coach->id}}">{{$Coach->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="coach_id"></label>
                </div>
                <div class="col-md-12"> <!-- extra -->
                    <label class="text-left">Extra</label><br>
                    @foreach($Extras as $Extra)
                        <div class="col-md-2">
                            <input type="checkbox" name="extras_id[]" value="{{$Extra->id}}">{{$Extra->name}}
                        </div>
                    @endforeach

                </div>
                <input type="hidden" id="renew" name="renew" value="0">
                <div class="col-md-6">
                    <input type="text" name="discount" placeholder="Discount"/>
                    <label class="alert" id="discount"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="paid" placeholder="Paid Money"/>
                    <label class="alert" id="paid"></label>
                </div>
                <div class="col-xs-12">
                    <h4 class="purple">Required Money : <span id="RequiredMoney" class="rose">0.00</span>
                        <button type="button" id="Calc" class="main-button sm-button">Calculate</button>
                    </h4>

                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Subscription</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div> <!-- end popup content -->
    </div> <!-- add-player-popup -->
    <!-- End Add Player form -->
    <!-- Start Edit Type form -->
    <div id="update-subscription-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="UpdateSubscription" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text" name="id" class="hidden">
                <div class="col-md-12"> <!-- place -->
                    <select class="place" name="place_id">>
                        @foreach($Places as $Place)
                            <option value="{{$Place->id}}">{{$Place->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12"> <!-- squash association -->
                    <select class="coach" name="coach_id">
                        @foreach($Coaches as $Coach)
                            <option value="{{$Coach->id}}">{{$Coach->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Update Subscription</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Edit Type form -->
    <!-- Start Delete Coach form -->
    <div id="delete-subscription-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeleteSubscription" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Subscription
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Subscription</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <div id="renew-subscription-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content text-center">
            <h4 class="purple" style="text-transform: none">
                This Player has exist subscription.<br>
                Are you sure that you want to renew it ?
            </h4>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Yes</button>
                <button type="button" class="main-button no">No</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Type form -->
    <div role="tabpanel" class="tab-pane text-center active in" id="players"> <!-- Start tab players -->
        <div class="col-md-12"> <!-- search player -->
            <div class="col-xs-12 filter" id="Players-Filter"></div>
            <button data-popup="add-subscription-popup" type="button" class="main-button col-md-3">Add Subscription</button>
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

                    <td>{{$Subscription->id}}</td>
                    <td><a class="purple" href="/player/-{{$Subscription->player->id}}">{{$Subscription->player->user->name}}</a></td>
                    <td><a class="purple" href="/coach/-{{$Subscription->coach->id}}">{{$Subscription->coach->user->name}}</a></td>
                    <td>{{$Subscription->level->name}}</td>
                    <td>{{$Subscription->place->name}}</td>
                    <td>
                        @foreach($SubscriptionsExtras[$Subscription->id] as $extra)
                            <div>{{$extra}}</div>
                        @endforeach
                    </td>
                    <td>{{ date_format( new DateTime($Subscription->created_at),"Y-m-d")}}</td>
                    <td>{{$Subscription->endedat}}</td>
                    <td>{{$Subscription->total}}</td>
                    <td>{{$Subscription->discount}}</td>
                    <td>{{$Subscription->paid}}</td>
                    <td>{{$subscription->debt}}</td>
                    <td>
                        <div id="place" class="hidden">{{$Subscription->place->id}}</div>
                        <div id="coach" class="hidden">{{$Subscription->coach->id}}</div>
                        <i class="fa fa-pencil white UpdateSubscription" data-id="{{$Subscription->id}}" data-popup="update-subscription-popup"></i>
                        <i class="fa fa-close white DeleteSubscription" data-id="{{$Subscription->id}}" data-popup="delete-subscription-popup"></i>
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
