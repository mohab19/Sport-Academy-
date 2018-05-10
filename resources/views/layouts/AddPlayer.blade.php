<form id="AddPlayer" enctype="multipart/form-data" method="POST" class="text-center" action="">
    {!! csrf_field() !!}
    <div class="col-md-12"> <!-- player name -->
        <input type="text" name="full_name" placeholder="Full Name"/>
        <label class="alert" id="Player_fullname"></label>
    </div>
    <div class="col-md-6"> <!-- school name -->
        <input type="text" name="school" placeholder="School Name"/>
        <label class="alert" id="Player_school"></label>
    </div>
    <div class="col-md-6">
        <input type="text" name="email" placeholder="Email"/>
        <label class="alert" id="Player_email"></label>
    </div>
    <div class="col-md-12">
        <label class="text-left">Birthdate</label>
        <input type="date" name="birthdate" placeholder="Birthdate"/>
        <label class="alert" id="Player_birthdate"></label>
    </div>
    <div class="col-md-6">
        <input type="text" name="home" placeholder="Home Number"/>
        <label class="alert" id="Player_home"></label>
    </div>
    <div class="col-md-6">
        <input type="text" name="phone" placeholder="Mobile Number"/>
        <label class="alert" id="Player_phone"></label>
    </div>
    <div class="col-md-12">
        <input type="text" name="address" placeholder="Address"/>
        <label class="alert" id="Player_address"></label>
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
        <label class="alert" id="Player_username"></label>
    </div>
    <div class="col-md-6">
        <input type="password" name="password" placeholder="Password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"/>
        <label class="alert" id="Player_password"></label>
    </div>
    {{--<div class="col-xs-12 text-center">--}}
    {{--<label class="fl-left" style="margin:0 50px">Is that your first time to play ?</label>--}}
    {{--<input value="yes" name="firsttime" id="yes" class="fl-left" type="radio">--}}
    {{--<label for="yes" class="fl-left" style="margin-left:2px;font-size:14px;">Yes</label>--}}
    {{--<input value="no" style="margin-left:50px" name="firsttime" id="no" class="fl-left" type="radio">--}}
    {{--<label for="no" class="fl-left" style="margin-left:2px;font-size:14px;">No</label>--}}
    {{--</div>--}}
    <div id="not_first_time" style="display: none">
        <div class="col-md-6">
            <input type="number" name="current_rank" placeholder="Current Rank">
            <label class="alert" id="Player_current_rank"></label>
        </div>
        <div class="col-md-6">
            <input type="number" name="best_rank" placeholder="Best Rank">
            <label class="alert" id="Player_best_rank"></label>
        </div>
        <div class="col-md-12">
            <input type="text" name="old_places" placeholder="Where did you play before?">
            <label class="alert" id="Player_old_places"></label>
        </div>
        <div class="col-md-12">
            <input type="text" name="duration" placeholder="How long have you been there?">
            <label class="alert" id="Player_duration"></label>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="text-center col-md-6 col-xs-12">
    </div>
    <div class="col-xs-12 text-left">
        <label >Profile Picture</label>
        <input type="file" name="picture" id="Picture">
        <label class="alert" id="Player_picture"></label>
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <button type="submit" class="main-button">Sign up</button>
    </div>
    <div class="clearfix"></div>
    <div class="alert"></div>
    <div class="clearfix"></div>

</form>