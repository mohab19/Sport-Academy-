<div id="update-group-popup" class="popup"> <!-- update-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content"> <!-- start popup-content -->
        <form id="UpdateGroup" method="POST" class="text-center" action="">
            <input type="hidden" name="id" value="{{$group->id}}">
            {!! csrf_field() !!}
            <div class="col-md-12"> <!-- Employee name -->
                <input type="text" name="name" value="{{$group->name}}"/>
                <label class="alert" id="Group_name"></label>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Update Group</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- update-Employee-popup -->