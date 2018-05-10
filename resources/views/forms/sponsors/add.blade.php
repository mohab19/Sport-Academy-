<div id="add-sponsor-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="AddSponsor" method="POST" enctype="multipart/form-data" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-6 col-xs-12">
                <input type="text" name="title" placeholder="Sponsor Title">
                <label class="alert" id="sponsor_title"></label>
            </div>
            <div class="col-md-6 col-xs-12 text-center">
                <input type="file" name="picture" id="Picture">
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add Sponsor</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>