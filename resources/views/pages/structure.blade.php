@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

@endsection

@section('title')
    Struture
@endsection

@section('tab')
    @include('forms.structure.playgrounds.add')
    @include('forms.structure.playgrounds.update')
    @include('forms.structure.playgrounds.delete')
    <div id="add-level-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="AddLevel" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-6">
                    <input type="text" name="name" placeholder="Level Name"/>
                    <label class="alert" id="Level_name"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="price" placeholder="Level Price"/>
                    <label class="alert" id="Level_price"></label>
                </div>
                <div class="col-md-12">
                    <input type="number" name="max" placeholder="Level Maximum Number"/>
                    <label class="alert" id="Level_max"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="notes" placeholder="Package"/>
                    <label class="alert" id="Level_notes"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Level</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <!-- End Add Level form -->

    <!-- Start Edit Level form -->
    <div id="update-level-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="UpdateLevel" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text" name="id" class="hidden">
                <div class="col-md-6">
                    <label>Level Name</label>
                    <input type="text" class="Name" name="name"/>
                    <label class="alert" id="Level_name"></label>
                </div>
                <div class="col-md-6">
                    <label>Level Price</label>
                    <input type="text" class="Price" name="price"/>
                    <label class="alert" id="Level_price"></label>
                </div>
                <div class="col-md-12">
                    <label>Level Maximum Number</label>
                    <input type="number" class="Max" name="max"/>
                    <label class="alert" id="Level_max"></label>
                </div>
                <div class="col-md-12">
                    <label>Package</label>
                    <input type="text" class="Notes" name="notes"/>
                    <label class="alert" id="Level_notes"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Update Level</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Edit Level form -->

    <!-- Start Delete Level form -->
    <div id="delete-level-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeleteLevel" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Level
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Level</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Level form -->
    <!-- Start Add Level form -->
    <div id="add-place-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="AddPlace" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-6">
                    <input type="text" name="name" placeholder="Name"/>
                    <label  class="alert" id="Place_name"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="price" placeholder="Rent Price"/>
                    <label class="alert" id="Place_price"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="address" placeholder="Address"/>
                    <label class="alert" id="Place_address"></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="map" placeholder="Map"/>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Place</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <!-- End Add Place form -->

    <!-- Start Edit Place form -->
    <div id="update-place-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="UpdatePlace" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text" name="id" class="hidden">
                <div class="col-md-6">
                    <label>Place Name</label>
                    <input type="text" class="Name" name="name"/>
                    <label class="alert" id="Place_name"></label>
                </div>
                <div class="col-md-6">
                    <label>Place Name</label>
                    <input type="text" class="Price" name="price"/>
                    <label class="alert" id="Place_name"></label>
                </div>
                <div class="col-md-12">
                    <label>Place Address</label>
                    <input type="text" class="Address" name="address"/>
                    <label class="alert" id="Place_address"></label>
                </div>
                <div class="col-md-12">
                    <label>Place Map</label>
                    <input type="text" class="Map" name="map"/>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Update Place</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Edit Place form -->

    <!-- Start Delete Place form -->
    <div id="delete-place-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeletePlace" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Place
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Place</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Place form -->

    <!-- Start Add Level form -->
    <div id="add-extra-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-Extrament="right" title="Close"></i>

        <div class="popup-content">
            <form id="AddExtra" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <div class="col-md-6">
                    <input type="text" name="name" placeholder="Extra Name"/>
                    <label id="Extra_name"></label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="price" placeholder="Extra Price"/>
                    <label id="Extra_price"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Add Extra</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <!-- End Add Extra form -->

    <!-- Start Edit Extra form -->
    <div id="update-extra-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="UpdateExtra" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text" name="id" class="hidden">
                <div class="col-md-6">
                    <label>Extra Name</label>
                    <input type="text" class="Name" name="name"/>
                    <label class="alert" id="Extra_name"></label>
                </div>
                <div class="col-md-6">
                    <label>Extra Price</label>
                    <input type="text" class="Price" name="price"/>
                    <label class="alert" id="Extra_price"></label>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Update Extra</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Edit Extra form -->

    <!-- Start Delete Extra form -->
    <div id="delete-extra-popup" class="popup"> <!-- add-player-popup -->
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="popup-content">
            <form id="DeleteExtra" method="POST" class="text-center" action="">
                {!! csrf_field() !!}
                <input type="text"  name="id" class="hidden">
                <h3 class="purple">
                    Are You Sure You Want Delete This Extra
                </h3>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">Delete Extra</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>

            </form>
        </div>

    </div>
    <!-- End Delete Extra form -->

    <div role="tabpanel" class="tab-pane text-center active in" id="players"> <!-- Start tab players -->
        <div class="col-md-6">
        <div class="col-md-12 text-center"> <!-- search player -->
            <button data-popup="add-playground-popup" type="button" class="main-button">Add Playground</button>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 box"> <!-- start players table -->
            <table class="table text-center">
                <thead> <!-- main row -->
                <tr class="info">
                    @foreach($playgroundsFields as $playgroundField)
                        <th>
                            {{$playgroundField}}
                        </th>
                    @endforeach
                    <th>
                        Options
                    </th>

                </tr>
                </thead> <!-- main row -->
                <tbody>
                @foreach($playgrounds as $playground)
                    <tr class="danger">
                        <td id="title">
                            {{$playground->title}}
                        </td>
                        <td >
                            {{$playground->place->name}}
                        </td>
                        <td id="notes">
                            {{$playground->notes}}
                        </td>
                        <td>
                            <i class="fa fa-pencil white UpdatePlayground" data-id="{{$playground->id}}" data-popup="update-playground-popup"></i>
                            <i class="fa fa-close white DeletePlayground"data-id="{{$playground->id}}" data-popup="delete-playground-popup"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table> <!-- table -->
        </div>
        </div>
        <div class="col-md-6">
        <div class="col-md-12 text-center"> <!-- search player -->
            <button data-popup="add-level-popup" type="button" class="main-button">Add Level</button>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 box"> <!-- start players table -->
            <table class="table text-center">
                <thead> <!-- main row -->
                <tr class="info">
                    @foreach($levelsFields as $levelField)
                        <th>
                            {{$levelField}}
                        </th>
                    @endforeach
                    <th>
                        Options
                    </th>

                </tr>
                </thead> <!-- main row -->
                <tbody>
                @foreach($levels as $level)
                    <tr class="danger">
                        <td id="name">
                            {{$level->name}}
                        </td>
                        <td id="price">
                            {{$level->price}}
                        </td>
                        <td id="notes">
                            {{$level->notes}}
                        </td>
                        <td id="max">
                            {{$level->max}}
                        </td>


                        <td>
                            <i class="fa fa-pencil white UpdateLevel" data-id="{{$level->id}}" data-popup="update-level-popup"></i>
                            <i class="fa fa-close white DeleteLevel"data-id="{{$level->id}}" data-popup="delete-level-popup"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table> <!-- table -->
        </div>
        </div>
        @if($user->role_id == 1 ||$user->role_id == 2 )
        <div class="col-md-6 places">
            <div class="col-md-12 text-center"> <!-- search player -->
                <button data-popup="add-place-popup" type="button" class="main-button">Add Place</button>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 box"> <!-- start players table -->
                <table class="table text-center">
                    <thead> <!-- main row -->
                    <tr class="info">
                        @foreach($placesFields as $placeField)
                            <th>
                                {{$placeField}}
                            </th>
                        @endforeach
                        <th>
                            Options
                        </th>

                    </tr>
                    </thead> <!-- main row -->
                    <tbody>
                    @foreach($places as $place)
                        <tr class="danger">

                            <td id="name">
                                {{$place->name}}
                            </td>
                            <td id="price">
                                {{$place->price}}
                            </td>
                            <td id="address">
                                {{$place->address}}
                            </td>
                            <td id="map">
                                {{$place->map}}
                            </td>
                            <td>
                                <i class="fa fa-pencil white UpdatePlace" data-id="{{$place->id}}" data-popup="update-place-popup"></i>
                                <i class="fa fa-close white DeletePlace"data-id="{{$place->id}}" data-popup="delete-place-popup"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> <!-- table -->
            </div>
        </div>

        <div class="col-md-6 extra">
            <div class="col-md-12 text-center"> <!-- search player -->
                <button data-popup="add-extra-popup" type="button" class="main-button">Add Extra</button>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 box"> <!-- start players table -->
                <table class="table text-center">
                    <thead> <!-- main row -->
                    <tr class="info">
                        @foreach($ExtraFields as $ExtraField)
                            <th>
                                {{$ExtraField}}
                            </th>
                        @endforeach
                        <th>
                            Options
                        </th>

                    </tr>
                    </thead> <!-- main row -->
                    <tbody>
                    @foreach($extras as $extra)
                        <tr class="danger">

                            <td id="name">
                                {{$extra->name}}
                            </td>
                            <td id="price">
                                {{$extra->price}}
                            </td>

                            <td>
                                <i class="fa fa-pencil white UpdateExtra" data-id="{{$extra->id}}" data-popup="update-extra-popup"></i>
                                <i class="fa fa-close white DeleteExtra"data-id="{{$extra->id}}" data-popup="delete-extra-popup"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> <!-- table -->
            </div>
        </div>
        @endif
    </div>
@endsection
@section('script')

    <script src="{{ asset('Ajax/Structure.js')}}"></script>

@endsection