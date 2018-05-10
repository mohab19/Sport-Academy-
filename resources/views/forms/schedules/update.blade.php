<form id="UpdateSchedule" method="POST">
    <table class="table">
        <thead>
        <tr class="info">
            <th>Title</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        {!! csrf_field() !!}
        <tr class="danger">
            <td>Coach</td>
            <td>
                    <div class="col-md-12"> <!-- place -->
                        <select name="coach_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                            <option value="">Choose Coach</option>
                            @foreach($schedule->place->coaches_places as $coach_place)
                                <option @if($schedule->coach->id == $coach_place->coach->id) selected @endif value="{{$coach_place->coach->id}}">{{$coach_place->coach->user->short_name}}</option>
                            @endforeach
                        </select>
                        <label class="alert" id="schedule_coach"></label>
                    </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Playground</td>
            <td>
                    <div class="col-md-12"> <!-- place -->
                        <select name="playground_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                            <option value="">Choose Playground</option>
                        @foreach($schedule->place->playgrounds as $playground)
                                <option @if($schedule->playground) @if($playground->id == $schedule->playground->id) selected @endif @endif value="{{$playground->id}}">{{$playground->title}}</option>
                            @endforeach
                        </select>
                        <label class="alert" id="schedule_coach"></label>
                    </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Schedule</td>
            <td>
                <div class="times">
                    <div class="time col-xs-12">
                        <div class="col-md-6">
                            <input type="time" value="{{$schedule->from}}" name="from">
                        </div>
                        <div class="col-md-6">
                            <input type="time" value="{{$schedule->to}}" name="to">
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    <div class="clearfix"></div>
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