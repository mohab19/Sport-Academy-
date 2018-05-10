@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <style>
        #control-panel .tab-content
        {
            padding-top: 0 !important;
        }
        .nav-tabs.settings
        {
            margin-bottom: 30px !important;
        }
        .nav-tabs.settings li
        {
            text-align: center;
        }
        .nav-tabs.settings li span
        {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('title')
    Settings
    @endsection

    @section('tab')
        <ul class="nav nav-tabs settings" role="tablist"> <!-- start Nav -->
            <li class="active" role="presentation">
                <a href="#Info" aria-controls="settings" role="tab" data-toggle="tab">
                    <span><i class="fa fa-gear fa-2x" aria-hidden="true"></i></span>
                    <p>Update Info</p>
                </a>
            </li>
            <li class="" role="presentation">
                <a href="#Picture" aria-controls="settings" role="tab" data-toggle="tab">
                    <span><i class="fa fa-gear fa-2x" aria-hidden="true"></i></span>
                    <p>Update Picture</p>
                </a>
            </li>
            <li role="presentation">
                <a href="#Password" aria-controls="settings" role="tab" data-toggle="tab">
                    <span><i class="fa fa-gear fa-2x" aria-hidden="true"></i></span>
                    <p>Update Password</p>
                </a>
            </li>
            <li role="presentation">
                <a href="/logout">
                    <span><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></span>
                    <p>Logout</p>
                </a>
            </li>
        </ul> <!-- End Nav -->
        <div id="settings">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active fade in" id="Info">
                    <form id="UpdateInfo">
                        {!! csrf_field() !!}
                        <div class="col-md-12 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Full Name</label>
                            <input type="text" name="full_name" value="{{$user->full_name}}">
                            <label class="alert" id="User_fullname"></label>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Phone</label>
                            <input type="text" name="phone" value="{{$user->phone}}">
                            <label class="alert" id="User_phone"></label>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Address</label>
                            <input type="text" name="address" value="{{$user->address}}">
                            <label class="alert" id="User_address"></label>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->role->name=="Player")
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">School</label>
                            <input type="text" name="school" value="{{$user->player->school}}">
                            <label class="alert" id="User_school"></label>
                        </div>
                        @endif
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Facebook</label>
                            <input type="text" name="facebook" value="{{$user->facebook}}">
                            <label class="alert" id="User_facebook"></label>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Email</label>
                            <input type="text" name="email" value="{{$user->email}}">
                            <label class="alert" id="User_email"></label>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Username</label>
                            <input type="text" name="username" value="{{$user->username}}">
                            <label class="alert" id="User_username"></label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="alert text-center"></div>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <button class="main-button">Update</button>
                        </div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="Password">
                    <form id="UpdatePassword">
                                                {!! csrf_field() !!}

                        <div class="col-md-12 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Old Password</label>
                            <input type="password" name="old_password" value="">
                            <label class="alert" id="User_old_password"></label>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">New Password</label>
                            <input type="password" name="password" value="">
                            <label class="alert" id="User_password"></label>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center">
                            <label class="text-left" style="margin-left: 15px;">Password Confirm</label>
                            <input type="password" name="password_confirmation" value="">
                            <label class="alert" id="User_password_confirm"></label>
                        </div>
                        <div class="alert text-center"></div>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <button class="main-button">Update</button>
                        </div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="Picture">
                    <form enctype="multipart/form-data" id="UpdatePicture">
                                                {!! csrf_field() !!}

                        <div class="text-center">
                            @if($user->picture)
                                <img  src="{{$user->picture}}" width="300"/>
                            @else
                                <img src="images/Users/default.gif" width="300"/>
                            @endif
                            <input type="file" name="picture" id="Picture">
                            <label class="alert" id="User_picture"></label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="alert text-center"></div>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <button class="main-button">Update</button>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    @endsection
@section('script')

    <script src="{{ asset('Ajax/settings.js')}}"></script>

@endsection