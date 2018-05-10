<div id="add-attachment-popup" class="popup">
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <!--===== POPUP BODY ======-->
    <div class="popup-body text-center">
        <form id="AddAttachment" method="POST"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="col-md-6 col-xs-12">
                <input type="text" name="title" placeholder="Title">
                <label id="attachment_title" class="alert"></label>
            </div>
            <div class=" col-md-6 col-xs-12 text-center">
                <input type="file" name="picture[]" multiple>
                <label id="attachment_value" class="alert"></label>
            </div>
            <div class="clearfix"></div>
            <div class="text-center">
                <button type="submit" class="main-button">Add Attachment</button>
            </div>
            <div class="alert"role="alert">

            </div>
        </form>
    </div>
</div>