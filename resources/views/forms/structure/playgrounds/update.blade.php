<div id="update-playground-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content">
        <form id="UpdatePlayground" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="text" name="id" class="hidden">
            <div class="col-md-12">
                <label>Playground Name</label>
                <input type="text" class="Title" name="title"/>
                <label class="alert" id="Playground_title"></label>
            </div>
            <div class="col-md-12">
                <label>Playground Notes</label>
                <input type="text" class="Notes" name="notes"/>
                <label class="alert" id="Playground_notes"></label>
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Update Playground</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>

        </form>
    </div>

</div>