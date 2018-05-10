<div id="add-income-popup" class="popup"> <!-- add-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content"> <!-- start popup-content -->
        <form id="AddInCome" enctype="multipart/form-data" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-12">
                <select name="place_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    <option disabled selected value="">Choose Place</option>
                    @foreach($places as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                </select>
                <label class="alert" id="income_place"></label>
            </div>
            <div class="col-md-12"> <!-- Employee name -->
                <input type="text" name="title" placeholder="Description"/>
                <label class="alert" id="income_title"></label>
            </div>
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="client_name" placeholder="Client Name"/>
                <label class="alert" id="income_client_name"></label>
            </div>
            <div class="col-md-6"> <!-- Employee name -->
                <input type="text" name="value" placeholder="Paid"/>
                <label class="alert" id="income_value"></label>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add InCome</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- add-Employee-popup -->