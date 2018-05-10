@extends('layouts.master')

@section('style')


@endsection

@section('title')
    {{$coach->user->full_name . " " .$coach->user->last_name}}
@endsection

@section('contents')
    @include('forms.users.penalties.add')
    @include('forms.users.penalties.update')
    @include('forms.users.penalties.delete')
    @include('forms.users.extras.add')
    @include('forms.users.extras.update')
    @include('forms.users.extras.delete')
    @include('forms.users.attachments.add')
    @include('forms.users.debts.pay')
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Coach : {{$coach->user->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('coaches')}}">Back To Coaches</a> </h5>
        </div>
    </section>
    <div id="private">
        <input type="hidden" id="CoachID" value="{{$coach->id}}">
        <input type="hidden" id="UserID" value="{{$coach->user_id}}">
    </div>
    <div class="content">
        <div class="container-fluid">

            <div class="box box-lg info">
                <h3 class="title rose">Info</h3>
                <form id="UpdateCoach" enctype="multipart/form-data" method="POST">
                    <table class="table">
                        <thead>
                        <tr class="info">
                            <th>Title</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>

                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$coach->id}}">
                        <tr class="danger">
                            <td>Photo</td>
                            <td>
                                <div class="col-md-12" style="margin-bottom:20px;">
                                    <img src="@if($coach->user->picture){{$coach->user->picture}}@else {{asset('images/Users/default.gif')}} @endif" width="300">
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
                                    <input class="sm" type="text" name="full_name" value="{{$coach->user->full_name}}">
                                    <label class="alert" id="Coach_fullname"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Birthdate</td>
                            <td>
                                <div class="col-md-12">
                                    <input class="sm" type="date" name="birthdate" value="{{date('Y-m-d',strtotime($coach->user->birth))}}">
                                    <label class="alert" id="Coach_birthdate"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Phone</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="phone" value="{{$coach->user->phone}}">
                                    <label class="alert" id="Coach_phone"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Address</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="address" value="{{$coach->user->address}}">
                                    <label class="alert" id="Coach_address"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Email</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="email" value="{{$coach->user->email}}">
                                    <label class="alert" id="Coach_email"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Username</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" name="username" value="{{$coach->user->username}}">
                                    <label class="alert" id="Coach_username"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Default Password</td>
                            <td>
                                <div class="col-md-12">
                                    <label>coach{{$coach->user->id}}</label>
                                </div>
                            </td>
                        </tr>
                        @if($user->role_id == 1 ||$user->role_id == 2 )
                            <tr class="danger">
                            <td>Salary</td>
                            <td>
                                <div class="col-md-12">
                                    <input type="text" class="sm" value="{{$coach->salary}}" name="salary"/>
                                    <label class="alert" id="Coach_salary"></label>
                                </div>
                            </td>
                        </tr>
                            @endif
                        <tr class="danger">
                            <td>Type</td>
                            <td>
                                <div class="col-md-12">
                                    <select class="sm" name="type_id">
                                        @foreach($types as $type)
                                            <option @if($coach->type->id == $type->id ) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Places</td>
                            <td>
                                <div class="col-md-12 text-center">

                                            <div class="col-xs-12">
                                                <select multiple title="Choose Place" data-width="100%" name="places_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                                                    @foreach($places as $place)
                                                        <option
                                                                @foreach($coach->coach_places as $coach_place)
                                                                @if($coach_place->place->id == $place->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                                value="{{$place->id}}">{{$place->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    <div class="text-center"></div>
                                            <label for="" class="alert text-center" id="Coach_places_id"></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Levels</td>
                            <td>
                                <div class="col-md-12 text-center">
                                            <div class="col-xs-12">
                                                <select multiple title="Choose Level" data-width="100%" name="levels_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                                                    @foreach($levels as $level)
                                                        <option
                                                                @foreach($coach->coach_levels as $coach_level)
                                                                @if($coach_level->level->id == $level->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                                value="{{$level->id}}">{{$level->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    <div class="text-center"></div>
                                            <label for="" class="alert text-center" id="Coach_places_id"></label>
                                </div>
                            </td>
                        </tr>
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

            <div class="box text-center">
                <h3 class="title rose text-left">Penalties</h3>
                <div class="text-right">
                    <button class="main-button" data-popup="add-penalty-popup">Add Penalty</button>
                </div>
                <table id="penalties-table" class="table text-center list-view">
                    <thead>
                    <tr class="info">
                        <th>Reason</th>
                        <th>Value</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($coach->user->outcomes)
                        @foreach($coach->user->outcomes as $outcome)
                            @if($outcome->outcomes_type_id == 4)
                                <tr class="danger">
                                    <td id="title">{{$outcome->title}}</td>
                                    <td id="value">{{$outcome->value}}</td>
                                    <td>{{$outcome->date}}</td>
                                    <td>
                                        <i data-id="{{$outcome->id}}" class="fa fa-pencil white UpdatePenaltyButton" data-popup="update-penalty-popup"></i>
                                        <i data-id="{{$outcome->id}}" class="fa fa-close white DeletePenaltyButton" data-popup="delete-penalty-popup"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="box text-center">
                <h3 class="title rose text-left">Extras</h3>
                <div class="text-right">
                    <button class="main-button" data-popup="add-extra-popup">Add Extra</button>
                </div>
                <table id="extras-table" class="table text-center list-view">
                    <thead>
                    <tr class="info">
                        <th>Reason</th>
                        <th>Value</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($coach->user->outcomes)
                        @foreach($coach->user->outcomes as $outcome)
                            @if($outcome->outcomes_type_id == 5)
                                <tr class="danger">
                                    <td id="title">{{$outcome->title}}</td>
                                    <td id="value">{{$outcome->value}}</td>
                                    <td>{{$outcome->date}}</td>
                                    <td>
                                        <i data-id="{{$outcome->id}}" class="fa fa-pencil white UpdateExtraButton" data-popup="update-extra-popup"></i>
                                        <i data-id="{{$outcome->id}}" class="fa fa-close white DeleteExtraButton" data-popup="delete-extra-popup"></i>

                                    </td>
                                </tr>
                            @endif
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
                    @if($coach->user->absences)
                        @foreach($coach->user->absences as $absence)
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
                    @if($coach->user->incomes)
                        @foreach($coach->user->incomes as $income)
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
            <div class="box box-lg text-center">
                <h3 class="title rose text-left">Attachments</h3>
                <div class="text-right">
                    <button class="main-button" data-popup="add-attachment-popup">Add Attachment</button>
                </div>
                <table id="attachments-table" class="table text-center list-view">
                    <thead>
                    <tr class="info">
                        <th>Title</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($coach->user->attachments)
                        @foreach($coach->user->attachments as $attachment)
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
                    {{--@foreach($coach->schedules as $schedule)--}}
                        {{--@foreach($schedule->subscriptions as $schedule_subscription)--}}
                            {{--<tr class="danger">--}}
                                {{--<td>--}}
                                    {{--<a style="color:#5356a5 !important" href="/player/{{$schedule_subscription->subscription->player->id}}/{{$schedule_subscription->subscription->player->user->name}}">--}}
                                        {{--{{$schedule_subscription->subscription->player->user->name}}--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{$schedule->place->name}}--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
@section('script')
    <script src="{{ asset('Ajax/Coach.js')}}"></script>
    <script src="{{ asset('Ajax/Penalties_Extras.js')}}"></script>
    <script src="{{ asset('Ajax/Attachments.js')}}"></script>
    <script src="{{ asset('Ajax/Debts.js')}}"></script>
@endsection