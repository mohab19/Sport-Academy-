<div id="add-playground-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content">
        <form id="AddPlayground" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-6">
                <input type="text" name="title" placeholder="Playground Title"/>
                <label class="alert" id="Playground_title"></label>
            </div>
            <div class="col-md-6">
                <input type="text" name="notes" placeholder="Playground Notes"/>
                <label class="alert" id="Playground_notes"></label>
            </div>
            <div class="col-md-12"> <!-- squash association -->
                <select name="place_id">
                    <option disabled selected value="">Choose Place</option>
                    @foreach($places as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                        @endforeach
                </select>
                <label class="alert" id="Playground_place"></label>
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add Playground</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>

</div>