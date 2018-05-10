<form id="AddAttendance">
    {!! csrf_field() !!}
    <table class="table">
        <thead>
        <tr class="info">
            <th>Role</th>
            <th>Name</th>
            <th>Type</th>
            <th>Duration</th>
            <th>Attend?</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attendances as $attendance)
            @if($user->role_id == 3)
                @foreach($user->employee->employee_places as $employee_place)
                    @if($attendance->type == "Indivduale")
                    @if($employee_place->place_id ==$attendance->schedule->place_id)
                        <tr>
                            <td>
                                {{$attendance->user->role->name}}
                            </td>
                            <td class="name">
                                {{$attendance->user->name}}
                            </td>
                            <td>
                                {{$attendance->type}}
                            </td>
                            <td>
                                @if($attendance->schedule_id != null)
                                    {{$attendance->schedule->from}} -- {{$attendance->schedule->to}}
                                @else
                                    {{$attendance->team_schedule->from}} -- {{$attendance->team_schedule->to}}
                                @endif
                            </td>
                            <td>
<span class="checkbox">
    <input data-id="{{$attendance->id}}" type="checkbox"  name="attend"
           @if($attendance->attend == 1)
           checked
            @endif >
    <label data-on="Yes" data-off="No"></label>
</span>
                            </td>
                        </tr>
                        @endif
                        @else
                        @if($employee_place->place_id ==$attendance->team_schedule->place_id)
                            <tr>
                                <td>
                                    {{$attendance->user->role->name}}
                                </td>
                                <td class="name">
                                    {{$attendance->user->name}}
                                </td>
                                <td>
                                    {{$attendance->type}}
                                </td>
                                <td>
                                    @if($attendance->schedule_id != null)
                                        {{$attendance->schedule->from}} -- {{$attendance->schedule->to}}
                                    @else
                                        {{$attendance->team_schedule->from}} -- {{$attendance->team_schedule->to}}
                                    @endif
                                </td>
                                <td>
<span class="checkbox">
    <input data-id="{{$attendance->id}}" type="checkbox"  name="attend"
           @if($attendance->attend == 1)
           checked
            @endif >
    <label data-on="Yes" data-off="No"></label>
</span>
                                </td>
                            </tr>
                        @endif
                        @endif
                    @endforeach
                @else
            <tr>
                <td>
                    {{$attendance->user->role->name}}
                </td>
                <td class="name">
                     {{$attendance->user->name}}
                </td>
                <td>
                    {{$attendance->type}}
                </td>
                <td>
                    @if($attendance->schedule_id != null)
                    {{$attendance->schedule->from}} -- {{$attendance->schedule->to}}
                        @else
                        {{$attendance->team_schedule->from}} -- {{$attendance->team_schedule->to}}
                    @endif
                </td>
                <td>
<span class="checkbox">
    <input data-id="{{$attendance->id}}" type="checkbox"  name="attend"
           @if($attendance->attend == 1)
           checked
           @endif >
    <label data-on="Yes" data-off="No"></label>
</span>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div class="clearfix"></div>
</form>