<div id="add-news-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="AddNews" method="POST" enctype="multipart/form-data" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-xs-12">
                <input type="text" name="title" placeholder="Title">
                <label class="alert" id="news_title"></label>
    </div>
            <div class="col-xs-12">
                <textarea rows="7" name="body" placeholder="Contents"></textarea>
                <label class="alert" id="news_title"></label>
    </div>
            <div class="col-md-6 col-xs-12">
                <label>Cover Picture</label>
                <input type="file" name="cover" id="Picture">
            </div>
            <div class="col-md-6 col-xs-12">
                <label>Attachments</label>
                <input type="file" multiple name="pictures[]" id="Picture">
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add News</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>