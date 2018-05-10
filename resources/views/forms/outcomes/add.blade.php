<div id="add-outcome-popup" class="popup"> <!-- add-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content"> <!-- start popup-content -->
        <form id="AddOutCome" enctype="multipart/form-data" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-12">
                <select name="place_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    <option disabled selected value="">Choose Place</option>
                    @foreach($places as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                </select>
                <label class="alert" id="outcome_place"></label>
            </div>
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="title" placeholder="Title"/>
                <label class="alert" id="outcome_title"></label>
            </div>
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="value" placeholder="Value"/>
                <label class="alert" id="outcome_value"></label>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add OutCome</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- add-Employee-popup -->