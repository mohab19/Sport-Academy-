<div id="add-schedule-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="AddSchedule" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="hidden" name="place_id" value="{{$place->id}}">
            <input type="hidden" name="day_id">
            <div class="col-md-12"> <!-- squash association -->
                <input type="text" placeholder="Type" name="type">
                <label class="alert" id="schedule_type"></label>
            </div>
            <div class="clearfix"></div>
            <div class="times text-center">
                <div class="time col-xs-12">
                    <div class="col-md-6">
                        <label for="">From</label>
                        <input type="time" placeholder="From" name="from">
                        <label id="schedule_from" class="alert"></label>
                    </div>
                    <div class="col-md-6">
                        <label for="">To</label>
                        <input type="time" placeholder="To" name="to">
                        <label id="schedule_to" class="alert"></label>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-xs-12">
                <button type="submit" class="main-button">Add Schedule</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>