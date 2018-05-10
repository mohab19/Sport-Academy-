@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

@endsection

@section('title')
    Coaches
@endsection

@section('tab')

    <!-- Start Add Type form -->
    <div id="add-type-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="AddType" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-12">
                    <input type="text" name="name" placeholder="Coach Type"/>
                    <label id="Type_name"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Type</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <!-- End Add Type form -->

    <!-- Start Edit Type form -->
    <div id="update-type-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="UpdateType" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text" name="id" class="hidden">
                <div class="col-md-12">
                    <label>Type Name</label>
                    <input type="text" class="Name" name="name"/>
                    <label class="alert" id="Type_name"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Update Type</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Edit Type form -->

    <!-- Start Delete Type form -->
    <div id="delete-type-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeleteType" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Type
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Type</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Type form -->
    <!-- Start Add Player form -->
    <div id="add-coach-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content"> <!-- start popup-content -->
            <form id="AddCoach" enctype="multipart/form-data"  method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-12">
                    <input type="text" name="full_name" placeholder="Full Name"/>
                    <label class="alert" id="Coach_fullname"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="phone" placeholder="Phone"/>
                    <label class="alert" id="Coach_phone"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="address" placeholder="Address"/>
                    <label class="alert" id="Coach_address"></label>
                </div>
                <div class="col-md-12">
                    <label class="text-left">Birthdate</label>
                    <input type="date" name="birthdate" placeholder="Birthdate"/>
                    <label class="alert" id="Coach_birthdate"></label>
                </div>
                <div class="col-md-6">
                <select name="type_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    <option selected disabled value="">Choose Type</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                    <label class="alert" id="Coach_type"></label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <select multiple title="Choose Place" name="places_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                        @foreach($places as $place)
                            <option value="{{$place->id}}">{{$place->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="Coach_places"></label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <select multiple title="Choose Level" name="levels_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="Coach_levels"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="salary" placeholder="Salary"/>
                    <label class="alert" id="Coach_salary"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="email" placeholder="Email"/>
                    <label class="alert" id="Coach_email"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="facebook" placeholder="Facebook Link"/>
                </div>
                <div class="clearfix"></div>
                <div class="text-left" style="padding-left:20px;">
                    <label>Login Conditions</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="username" placeholder="Username" autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"/>
                    <label class="alert" id="Coach_username"></label>
                </div>
                <div class="col-md-6">
                    <input type="password" name="password" placeholder="Password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"/>
                    <label class="alert" id="Coach_password"></label>
                </div>
                <div class="col-xs-12 text-left">
                    <label >Profile Picture</label>
                    <input type="file" name="picture" id="Picture">
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Coach</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div> <!-- end popup content -->

    </div> <!-- add-player-popup -->
    <!-- End Add Player form -->
    <!-- End Edit Type form -->

    <!-- Start Delete Coach form -->
    <div id="delete-coach-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeleteCoach" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Coach
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Coach</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Type form -->
    <div role="tabpanel" class="tab-pane text-center active in" id="coaches"> <!-- Start tab players -->
        <div class="col-md-12 types">
            <div class="col-md-12 text-center"> <!-- search player -->
                <button data-popup="add-type-popup" type="button" class="main-button">Add Coache Type</button>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 box-lg"> <!-- start players table -->
                <table class="table text-center">
                    <thead> <!-- main row -->
                    <tr class="info">
                        @foreach($CoachesTypesFields as $CoachesTypesField)
                            <th>
                                {{$CoachesTypesField}}
                            </th>
                        @endforeach
                        <th>
                            Options
                        </th>

                    </tr>
                    </thead> <!-- main row -->
                    <tbody>
                    @foreach($types as $type)
                        <tr class="danger">

                            <td id="name">
                                {{$type->name}}
                            </td>
                            <td>
                                <i class="fa fa-close white DeleteType"data-id="{{$type->id}}" data-popup="delete-type-popup"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> <!-- table -->
            </div>
        </div>
        <div class="col-md-12"> <!-- search player -->
            <div class="col-xs-9 filter" id="Coaches-Filter"></div>
            <button data-popup="add-coach-popup" type="button" class="main-button col-md-3">Add Coach</button>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 box-lg"> <!-- start players table -->
            <table id="Players-table" class="table text-center list-view">
                <thead> <!-- main row -->
                <tr class="info">
                    @foreach($CoachesFields as $CoachesField)
                    <th>{{$CoachesField}}</th>
                    @endforeach
                    <th>Options</th>
                </tr>
                </thead> <!-- main row -->
                <tbody>
                @foreach($Coaches as $Coach)
                    <tr class="danger">
                        @if($Coach->user->picture)
                            <td><img src="{{$Coach->user->picture}}" width="60" height="60" class="img-rounded"/></td>
                        @else
                            <td><img src="images/Users/default.gif" width="60" height="60" class="img-rounded"/></td>
                        @endif
                        <td>{{$Coach->full_name}}</td>
                        <td id="birthdate">{{ date_format( new DateTime($Coach->birthdate),"Y-m-d")}}</td>
                        <td id="phone">{{$Coach->phone}}</td>
                        <td id="address">{{$Coach->address}}</td>
                        <td id="email">{{$Coach->email}}</td>
                        <td>{{$Coach->type->name}}</td>
                        <td id="places">
                            @foreach($Coach->coach_places as $coach_place)
                                <div>{{$coach_place->place->name}}</div>
                                @endforeach
                        </td>
                        <td id="levels">
                            @foreach($Coach->coach_levels as $coach_level)
                                <div>{{$coach_level->level->name}}</div>
                                @endforeach
                        </td>
                        <td id="facebook">
                                {{$Coach->user->facebook}}
                        </td>
                        <td>
                            <a href="{{"/coach/".$Coach->id."/".$Coach->user->name}}"><i class="fa fa-info"></i></a>
                            <i class="fa fa-close white DeleteCoach" data-id="{{$Coach->id}}" data-popup="delete-coach-popup"></i>
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

    <script src="{{ asset('Ajax/Coaches.js')}}"></script>

@endsection