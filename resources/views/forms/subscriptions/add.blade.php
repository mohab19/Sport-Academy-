<form id="AddSubscription" class="msform">
{!! csrf_field() !!}
<!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Player</li>
        <li>Information</li>
        <li>Schedule</li>
        <li>TeamSchedule</li>
        <li>Payment</li>
    </ul>
    <!-- fieldsets -->
    <fieldset data-form="player">
        <div class="fs-title">Who will be our hero ?</div>
        <div class="col-xs-12">
            <input type="text" id="SearchPlayerInput" placeholder="Search ... ">
        </div>
        @foreach($players as $player)
            <label>
                <input type="radio" name="player_id" value="{{$player->id}}">
                <div class="player">
                    <div class=" text-center">
                        {{--<img width="120" height="120" src="@if($player->user->picture){{$player->user->picture}}@else  {{ asset('images/Users/default.gif')}}  @endif">--}}
                    </div>
                    <div class="text">
                        {{$player->user->name}}
                    </div>
                </div>
            </label>
        @endforeach
        <div class="clearfix"></div>
        <button type="button" class="main-button next">Next</button>
    </fieldset>
    <fieldset data-form="info">
        <div class="fs-title">Let me know subscription information</div>
        <div class="col-md-12"> <!-- place -->
            <select name="place_id" class="" data-show-subtext="false" data-live-search="true">
                <option disabled selected value="">Choose Place</option>
                @foreach($places as $place)
                    <option value="{{$place->id}}">{{$place->name}}</option>
                @endforeach
            </select>
            <label class="alert" id="place_id"></label>
        </div>
        <div class="col-md-6"> <!-- level -->
            <select name="level_id" class="" data-show-subtext="false" data-live-search="true">
                <option disabled selected value="">Choose Level</option>
                @foreach($levels as $level)
                    <option value="{{$level->id}}">{{$level->name}}</option>
                @endforeach
            </select>
            <label class="alert" id="level_id"></label>
        </div>
        <div class="col-md-6"> <!-- extra -->
            <select multiple title="Choose Extra" name="extras_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                @foreach($extras as $extra)
                    <option value="{{$extra->id}}">{{$extra->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="clearfix"></div>
        <button type="button" class="main-button previous">Previous</button>
        <button type="button" class="main-button next">Next</button>
    </fieldset>
    <fieldset data-form="schedule">
        <div class="fs-title">When will he play ?</div>
        <input type="text" id="SearchScheduleInput" placeholder="Search ... ">
        <div class="fs-subtitle">Here is all Schedules in <b id="place"></b></div>
        <div class="schedules">

        </div>
        <div class="clearfix"></div>
        <button type="button" class="main-button previous">Previous</button>
        <button type="button" class="main-button next">Next</button>
    </fieldset>
    <fieldset data-form="teams_schedule">
        <div class="fs-title">When will he play with team ?</div>
        <div class="fs-subtitle">Here is all Teams Schedules in <b id="place"></b></div>
        <div class="teams_schedules">

        </div>
        <div class="clearfix"></div>
        <button type="button" class="main-button previous">Previous</button>
        <button type="button" class="main-button next">Next</button>
    </fieldset>
    <fieldset data-form="paying">
        <div class="fs-title">It's Paying Time</div>
        <h3 style="margin: 20px;">
            <label>Required Money : <b  class="rose" id="RequiredMoney"></b></label>
        </h3>
        <div class="col-md-6">
            <div class="col-xs-12"><input type="text" name="discount" placeholder="Discount"></div>
        </div>
        <div class="col-md-6">
            <div class="col-xs-12"><input type="text" name="paid" placeholder="Paid"></div>
        </div>
        <div class="clearfix"></div>
        <button type="button" class="main-button previous">Previous</button>
        <button type="submit" class="main-button">Confirm</button>
    </fieldset>
</form>
<div class="clearfix"></div>