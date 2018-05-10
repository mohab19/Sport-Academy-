<div id="delete-schedule-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content">
        <form id="DeleteSchedule" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <h3 class="purple">
                Are You Sure You Want Delete This Schedule?
            </h3>
            <div class="col-xs-12">
                <button type="submit" class="main-button DeleteScheduleButton">Delete Schedule</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>

        </form>
    </div>

</div>