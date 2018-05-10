@if($player->subscription)
    <form id="UpdateSubscription">
        {!! csrf_field() !!}
        <table class="table text-center">
        <thead>
        <tr class="info">
            <th>Title</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
            <tr class="danger">
                <td>Coach</td>
                <td>
                    <a class="purple" href="/coach/{{$player->subscription->schedule->schedule->coach->id}}/{{$player->subscription->schedule->schedule->coach->user->name}}">{{$player->subscription->schedule->schedule->coach->user->name}}</a>
                </td>
            </tr>
            <tr class="danger">
                <td>Place</td>
                <td>
                    <div class="col-md-12 text-center">
                        <div class="col-xs-12">
                            <select title="Choose Place" data-width="100%" name="place_id" class="selectpicker sm" data-show-subtext="false" data-live-search="true">
                                @foreach($places as $place)
                                    <option
                                            @foreach($player->subscription->schedules as $subscription_schedule)
                                            @if($subscription_schedule->schedule->place->id == $place->id)
                                            selected
                                            @endif
                                            @endforeach
                                            value="{{$place->id}}">{{$place->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center"></div>
                    </div>
                </td>
            </tr>
            <tr class="danger">
                <td>Level</td>
                <td><label class="text-left rose">{{$player->subscription->level->name}}</label></td>
            </tr>
            <tr class="danger">
                <td>Extra</td>
                <td>
                    @foreach($player->subscription->subscription_extras as $subscription_extra)
                        <label class="text-left rose">{{$subscription_extra->extra->name}}</label>
                        <div class="clearfix"></div>
                    @endforeach
                </td>
            </tr>
            <tr class="danger">
                <td>Duration</td>
                <td><label class="text-left rose">{{$player->subscription->start}} -- {{$player->subscription->end}} </label></td>
            </tr>
            <tr class="danger">
                <td>Total</td>
                <td>
                    <label class="text-left rose">{{$player->subscription->total}}</label>
                </td>
                <tr class="danger">
                <td>Discount</td>
                <td><label class="text-left rose">{{$player->subscription->discount}}</label></td>
            </tr>
                <tr class="danger">
                <td>Paid</td>
                <td><label class="text-left rose">{{$player->subscription->paid}}</label></td>
            </tr>
            @if($player->subscription->debt)
                <tr class="danger">
                <td>Remaining</td>
                <td class=""><label class="text-left rose">{{$player->subscription->debt}}</label>
                    <label class="text-left">
                        <button type="button" style="margin:0" data-id="{{$player->subscription->id}}" class="main-button sm-button PaySubscription" data-popup="pay-subscription-popup">Pay</button>
                    </label>
                </td>
            </tr>
                @endif
            <tr class="danger">
                <td>Schedule</td>
                <td>
                    <div class="schedules">
                    <table class='table'>
                            <thead>
                            <tr class='info'>
                                <th>Day</th>
                                <th>Schedules</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($days as $day)
                            <?php $schedules = \App\models\Schedule::where('place_id',$player->subscription->schedule->schedule->place->id)->where('day_id',$day->id)->get();?>
                            @if(sizeof($schedules))
                                <tr><td>{{$day->name}}</td><td>
                                        @foreach($day->schedules as $schedule)
                                       @if ($player->subscription->schedule->schedule->place->id == $schedule->place_id)
                                        <label><input type='checkbox' name='schedules_id[]'
                                                      @foreach($player->subscription->schedules as $subscription_schedule)
                                                      @if($subscription_schedule->schedule->id == $schedule->id)
                                                      checked
                                                      @endif
                                                      @endforeach
                                                      value='{{$schedule->id}}'>
                                            <div class='schedule'>
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                                <h5 class='purple'>{{$schedule->coach->user->name}}</h5>
                                            </div>
                                        </label>
                        @endif
                        @endforeach
                                    </td></tr>
                        @endif
                        @endforeach
                            </tbody></table>
                    </div>
                    <label for="" class="alert text-center" id="subscription_schedule"></label>
                </td>
            </tr>
            <tr class="danger">
                <td>Team Schedule</td>
                <td>
                    <div class="teams_schedules">
                    <table class='table'>
                            <thead>
                            <tr class='info'>
                                <th>Day</th>
                                <th>Schedules</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($days as $day)
                            <?php $schedules = \App\models\TeamSchedule::where('place_id',$player->subscription->schedule->schedule->place->id)->where('day_id',$day->id)->get();?>
                            @if(sizeof($schedules))
                                <tr><td>{{$day->name}}</td><td>
                                        @foreach($day->teams_schedules as $schedule)
                                       @if ($player->subscription->schedule->schedule->place->id == $schedule->place_id)
                                        <label><input type='radio' name='teams_schedules_id[]'
                                                      @foreach($player->subscription->teams_schedules as $subscription_schedule)
                                                      @if($subscription_schedule->team_schedule_id == $schedule->id)
                                                      checked
                                                      @endif
                                                      @endforeach
                                                      value='{{$schedule->id}}'>
                                            <div class='schedule'>
                                                <h4>{{$schedule->type}}</h4>
                                                <h4>{{$schedule->from}} -- {{$schedule->to}}</h4>
                                            </div>
                                        </label>
                        @endif
                        @endforeach
                                    </td></tr>
                        @endif
                        @endforeach
                            </tbody></table>
                    </div>
                    <label for="" class="alert text-center" id="subscription_schedule"></label>
                </td>
            </tr>
            <div class="clearfix"></div>

        </tbody>
    </table>
        <div class="alert"></div>
    <div class="text-center">
        <button type="submit" class="main-button">Update</button>
    </div>
    <div class="text-right">
        <button type="button" data-popup="delete-subscription-popup" class="main-button">Delete</button>
    </div>
</form>

@else
    <label class="purple">This is Deactivate Player</label>
@endif