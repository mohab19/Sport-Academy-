<div id="update-extra-popup" class="popup"> <!-- Update-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content"> <!-- start popup-content -->
        <form id="UpdateExtra" enctype="multipart/form-data" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="title" placeholder="Reason"/>
                <label class="alert" id="extra_title"></label>
            </div>
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="value" placeholder="Value"/>
                <label class="alert" id="extra_value"></label>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Update Extra</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- Update-Employee-popup -->