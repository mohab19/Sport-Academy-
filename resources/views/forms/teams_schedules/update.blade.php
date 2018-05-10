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
            <td>Type</td>
            <td>
                    <div class="col-md-12"> <!-- place -->
                        <input type="text" name="type" value="{{$schedule->type}}">
                        <label class="alert" id="schedule_type"></label>
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