<div id="update-post-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="UpdatePost" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="hidden" name="id">
            <div class="col-xs-12">
                <textarea name="body"></textarea>
                <label class="alert" id="Post_body"></label>
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Update</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>