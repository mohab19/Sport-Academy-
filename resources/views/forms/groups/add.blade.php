<div id="add-group-popup" class="popup"> <!-- add-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content"> <!-- start popup-content -->
        <form id="AddGroup"  method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-12"> <!-- Employee name -->
                <input type="text" name="name" placeholder="Group Name"/>
                <label class="alert" id="group_name"></label>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add Group</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- add-Employee-popup -->