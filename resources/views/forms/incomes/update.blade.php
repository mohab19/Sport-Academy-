<div id="update-income-popup" class="popup"> <!-- update-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content"> <!-- start popup-content -->
        <form id="UpdateInCome" enctype="multipart/form-data" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="title" placeholder="Title"/>
                <label class="alert" id="income_title"></label>
            </div>
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="value" placeholder="Value"/>
                <label class="alert" id="income_value"></label>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Update InCome</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- update-Employee-popup -->