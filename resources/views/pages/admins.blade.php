@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

@endsection

@section('title')
    Admins
@endsection

@section('tab')
    <!-- Start Add Player form -->
    <div id="add-admin-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content"> <!-- start popup-content -->
            <form id="AddAdmin" enctype="multipart/form-data" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-12"> <!-- player name -->
                    <input type="text" name="full_name" placeholder="Full Name"/>
                    <label class="alert" id="Admin_fullname"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="email" placeholder="Email"/>
                    <label class="alert" id="Admin_email"></label>
                </div>
                <div class="col-md-6">
                    <label class="text-left">Birthdate</label>
                    <input type="date" name="birthdate" placeholder="Birthdate"/>
                    <label class="alert" id="Admin_birthdate"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="phone" placeholder="Phone"/>
                    <label class="alert" id="Admin_phone"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="address" placeholder="Address"/>
                    <label class="alert" id="Admin_address"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="facebook" placeholder="Facebook Link"/>
                </div>
                <div class="col-md-12">
                    <select multiple title="Reports Permissions" name="reports_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                        @foreach($reports as $report)
                            <option value="{{$report->id}}">{{$report->title}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="text-left" style="padding-left:20px;">
                    <label>Login Conditions</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="username" placeholder="Username" autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"/>
                    <label class="alert" id="Player_username"></label>
                </div>
                <div class="col-md-6">
                    <input type="password" name="password" placeholder="Password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"/>
                    <label class="alert" id="Player_password"></label>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Admin</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div> <!-- end popup content -->

    </div> <!-- add-Admin-popup -->
    <!-- End Add Admin form -->
    <!-- Start Delete Coach form -->
    <div id="delete-admin-popup" class="popup"> <!-- add-admin-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeleteAdmin" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Admin
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Admin</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Type form -->
    <button class="main-button AddButton" data-popup="add-admin-popup">+</button>
    <div role="tabpanel" class="tab-pane text-center active in" id="admins"> <!-- Start tab admins -->
        <div class="col-md-12"> <!-- search admin -->
            <div class="col-md-12 filter" id="Players-Filter"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 box-lg"> <!-- start Admins table -->
            <table id="Players-table" class="table text-center list-view">
                <thead> <!-- main row -->
                <tr class="info">
                    @foreach($AdminsFields as $AdminsField)
                        <th>{{$AdminsField}}</th>
                    @endforeach
                    <th>Options</th>
                </tr>
                </thead> <!-- main row -->
                <tbody>
                @foreach($Admins as $Admin)
                    <tr class="danger">
                        @if($Admin->picture)
                            <td><img src="{{$Admin->picture}}" width="50"/></td>
                        @else
                            <td><img src="images/Users/default.gif" width="50"/></td>
                        @endif
                        <td>{{$Admin->name}}</td>
                        <td>{{ date_format( new DateTime($Admin->birthdate),"Y-m-d")}}</td>
                        <td>{{$Admin->address}}</td>
                        <td>{{$Admin->phone}}</td>
                        <td>{{$Admin->email}}</td>
                        <td>
                            @if($Admin->facebook)
                                <a target="_blank" href="{{$Admin->facebook}}"><i class="fa fa-facebook"></i></a>
                            @endif
                        </td>
                        <td>
                            @if($user->id != $Admin->id)
                            <i class="fa fa-close white DeleteAdmin" data-id="{{$Admin->id}}" data-popup="delete-admin-popup"></i>
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

    <script src="{{ asset('Ajax/admins.js')}}"></script>

@endsection