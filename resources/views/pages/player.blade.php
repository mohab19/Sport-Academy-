@extends('layouts.master')

@section('style')
    <style>
        label > input{ /* HIDE RADIO */
            visibility: hidden; /* Makes input not-clickable */
            position: absolute; /* Remove input from document flow */
        }
        label > input + div.player,
        label > input + div.schedule
        {
            cursor:pointer;
            border:2px solid #eee;
            transition: .4s all ease-in-out;
            padding: 5px;
        }
        label > input:checked + div.player,
        label > input:checked + div.schedule
        {
            border-color: #5356a5;
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
    {{$player->user->full_name}}
@endsection

@section('contents')
    @include('forms.subscriptions.delete')
    @include('forms.users.attachments.add')
    @include('forms.users.debts.pay')
    <div id="private"><input type="hidden" name="subscription_id" value="@if($player->subscription){{$player->subscription->id}}@endif"></div>
    <div id="pay-subscription-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="PaySubscription" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <div class="col-xs-12">
                    <input type="text" placeholder="Value" name="paid">
                    <label for="" class="alert" id="Player_paid"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Pay Subscription</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Player : {{$player->user->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('players')}}">Back To Players</a> </h5>
        </div>
    </section>
    <div id="private">
        <input type="hidden" id="PlayerID" value="{{$player->id}}">
        <input type="hidden" id="UserID" value="{{$player->user_id}}">
    </div>
    <div class="content">
        <div class="container-fluid">

            <div class="box box-lg info">
                <h3 class="title rose">Personal Information</h3>
                <form id="UpdatePlayer" enctype="multipart/form-data" method="POST">
                    <table class="table">
                        <thead>
                        <tr class="info">
                            <th>Title</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>

                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$player->id}}">
                        <tr class="danger">
                            <td>Photo</td>
                            <td>
                                <div class="col-md-12" style="margin-bottom:20px;">
                                    <img src="@if($player->user->picture){{$player->user->picture}}@else {{asset('images/Users/default.gif')}} @endif" width="300">
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="picture" id="Picture">
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Name</td>
                            <td>
                                <div class="col-md-12">
                                    <input class="sm" type="text" name="full_name" value="{{$player->user->full_name}}">
                                    <label class="alert" id="Player_fullname"></label>
</div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Birthdate</td>
                            <td>
                                <div class="col-md-12">
                                    <input class="sm" type="date" name="birthdate" value="{{date('Y-m-d',strtotime($player->user->birth))}}">
                                    <label class="alert" id="Player_birthdate"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>School</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="school" value="{{$player->school}}">
                                    <label class="alert" id="Player_school"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Address</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="address" value="{{$player->user->address}}">
                                    <label class="alert" id="Player_address"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Phone</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="phone" value="{{$player->user->phone}}">
                                    <label class="alert" id="Player_phone"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Email</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="email" value="{{$player->user->email}}">
                                    <label class="alert" id="Player_email"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Username</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="username" value="{{$player->user->username}}">
                                    <label class="alert" id="Player_username"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Default Password</td>
                            <td>
                                <div class="col-md-12">
                                    <label>player{{$player->user->id}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Social Media</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="facebook" value="{{$player->user->facebook}}">
                                </div>
                            </td>
                        </tr>
                        @if($player->best_rank)
                        <tr class="danger">
                            <td>Current Rank</td>
                            <td>
                                <label class="rose">{{$player->current_rank}}</label>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Best Rank</td>
                            <td>
                                <label class="rose">{{$player->best_rank}}</label>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Latest Places</td>
                            <td>
                                <label class="rose">{{$player->old_places}}</label>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Duration</td>
                            <td>
                                <label class="rose">{{$player->duration}}</label>
                            </td>
                        </tr>
                            @endif
            </tbody>
            </table>
            <div class="clearfix"></div>
            <div class="alert text-center"></div>
            <div class="clearfix"></div>
            <div class="text-center">
                <button class="main-button" type="submit">Update</button>
            </div>
            </form>

        </div>
            <div class="box box-lg recentsubscription text-center">
                <h3 class="title rose text-left">Recent Subscription</h3>
                @include('forms.subscriptions.update')
            </div>
        <div class="box oldsubscriptions">
            <h3 class="title rose">Old
                Subscriptions</h3>
            <table class="table">
                <thead>
                <tr class="info">
                    <th>No.</th>
                        {{--<th>Coach</th>--}}
                        {{--<th>Place</th>--}}
                    <th>Level</th>
                    <th>Extra</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Paid</th>
                    <th>Remaining</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($player->subscriptions)
                @foreach($player->subscriptions as $subscription)
                    <tr class="danger">
                        <td>{{$subscription->id}}</td>
                        {{--<td><a class="purple" href="/coach/{{$subscription->schedule->schedule->coach->id}}/{{$subscription->schedule->schedule->coach->user->name}}">{{$subscription->schedule->schedule->coach->user->name}}</a></td>--}}
                        {{--<td>{{$subscription->schedule->schedule->place->name}}</td>--}}
                        <td>{{$subscription->level->name}}</td>
                        <td>
                            @foreach($subscription->subscription_extras as $subscription_extra)
                                <div>{{$subscription_extra->extra->name}}</div>
                            @endforeach
                        </td>
                        <td>{{$subscription->start}}</td>
                        <td>{{$subscription->end}}</td>
                        <td>{{$subscription->total}}</td>
                        <td>{{$subscription->discount}}</td>
                        <td>{{$subscription->paid}}</td>
                        <td>{{$subscription->debt}}</td>
                        <td>
                            @if($subscription->debt)
                                <button class="main-button sm-button PaySubscription" data-id="{{$subscription->id}}" data-popup="pay-subscription-popup">Pay</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                    @endif
                </tbody>
            </table>
        </div>
            <div class="box text-center">
                <h3 class="title rose text-left">Absences</h3>
                <table id="Absences-table" class="table text-center">
                    <thead>
                    <tr class="info">
                        <th>Type</th>
                        <th>Date</th>
                        <th>Duration</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($player->user->absences)
                        @foreach($player->user->absences as $absence)
                            <tr class="danger">
                                <td>{{$absence->type}}</td>
                                <td>{{$absence->date}}</td>
                                @if($absence->type != "Team")
                                    <td>{{$absence->schedule->from}} -- {{$absence->schedule->to}}</td>
                                @else
                                    <td>{{$absence->team_schedule->from}} -- {{$absence->team_schedule->to}}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="text-center pagination">
                </div>
            </div>
            <div class="box paying text-center">
                <h3 class="title rose text-left">Products Debts</h3>
                <table class="table text-center">
                    <thead>
                    <tr class="info">
                        <th>Title</th>
                        <th>Value</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($player->user->incomes)
                        @foreach($player->user->incomes as $income)
                            @if($income->debt)
                                <tr class="danger">
                                <td>{{$income->product->name}}</td>
                                <td>{{$income->debt}}</td>
                                <td>
                                    <button class="main-button  PayProductDebt" data-id="{{$income->id}}" data-popup="pay-debt-popup">Pay</button>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="text-center pagination">

                </div>
            </div>
           d
                    @if($player->user->attachments)
                        @foreach($player->user->attachments as $attachment)
                            <?php $pictures = explode("||",$attachment->value) ?>
                            <tr class="danger">
                                <td id="title">{{$attachment->title}}</td>
                                <td id="value" class="text-center">
                                    @foreach($pictures as $picture)
                                        <div class="image text-center" style="display: inline-block">
                                            <div>
                                                <img src="{{$picture}}" width="200" height="100">
                                            </div>
                                            <div style="margin-top:5px;">
                                                <a href="{{$picture}}" download><button class="main-button sm-button">Download</button></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        <div class="box paying text-center">
            <h3 class="title rose text-left">Paying</h3>
            <div class="col-md-12 text-center"> <!-- search player -->
                <div class="col-md-12 filter" id="Players-Filter"></div>
            </div>
            <table id="Paying-table" class="table text-center list-view">
                <thead>
                <tr class="info">
                    <th>Title</th>
                    <th>Value</th>
                    <th>Receiver</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @if($player->incomes)
                @foreach($player->incomes as $income)
                    <tr class="danger">
                        <td>{{$income->title}}</td>
                        <td>{{$income->value}}</td>
                        <td>{{$income->receiver->name}}</td>
                        <td>{{$income->date}}</td>
                    </tr>
                @endforeach
                    @endif
                @if($player->user->incomes)
                @foreach($player->user->incomes as $income)
                    <tr class="danger">
                        <td>{{$income->title}}</td>
                        <td>{{$income->value}}</td>
                        <td>{{$income->receiver->name}}</td>
                        <td>{{$income->date}}</td>
                    </tr>
                    @if($income->deoon)
                        @foreach($income->deoon as $debt)
                            <tr class="danger">
                                <td>{{$debt->title}}</td>
                                <td>{{$debt->value}}</td>
                                <td>{{$debt->receiver->name}}</td>
                                <td>{{$debt->date}}</td>
                            </tr>
                        @endforeach
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
    <div class="clearfix"></div>
@endsection
@section('script')
    <script src="{{ asset('Ajax/Player.js')}}"></script>
    <script src="{{ asset('Ajax/Subscriptions.js')}}"></script>
    <script src="{{ asset('Ajax/Attachments.js')}}"></script>
    <script src="{{ asset('Ajax/Debts.js')}}"></script>
    <script>
        $('.schedules label input').click(function(){
            if($(this).is(':checked'))
            {
                $(this).parent().siblings().children("input").prop("checked" , false);
//                $(this).parent().siblings().hide();
            }
            else
                $(this).parent().siblings().show();
        })
    </script>
@endsection
