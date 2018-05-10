@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

@endsection

@section('title')
    Players
    @endsection

    @section('tab')
        <!-- Start Add Player form -->
        <div id="add-player-popup" class="popup"> <!-- add-player-popup -->
            <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

            <div class="popup-content"> <!-- start popup-content -->
                @include('layouts.AddPlayer')
            </div> <!-- end popup content -->

        </div> <!-- add-player-popup -->
        <!-- End Add Player form -->
        <!-- Start Delete Coach form -->
        <div id="delete-player-popup" class="popup"> <!-- add-player-popup -->
            <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

            <div class="popup-content">
                <form id="DeletePlayer" method="POST" class="text-center" action="">
                    {!! csrf_field() !!}
                    <input type="text"  name="id" class="hidden">
                    <h3 class="purple">
                        Are You Sure You Want Delete This Player
                    </h3>
                    <div class="col-xs-12">
                        <button type="submit" class="main-button">Delete Player</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="alert"></div>
                    <div class="clearfix"></div>

                </form>
            </div>

        </div>
        <!-- End Delete Type form -->
        <button class="main-button AddButton" data-popup="add-player-popup">+</button>
        <div role="tabpanel" class="tab-pane text-center active in" id="players"> <!-- Start tab players -->
            <div class="col-md-12"> <!-- search player -->
                <div class="col-xs-12 filter" id="Players-Filter"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 box-lg"> <!-- start players table -->
                <table id="Players-table" class="table text-center list-view">
                    <thead> <!-- main row -->
                    <tr class="info">
                        @foreach($PlayersFields as $PlayersField)
                            <th>{{$PlayersField}}</th>
                        @endforeach
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    </thead> <!-- main row -->
                    <tbody>
                    @foreach($Players as $Player)
                        <tr class="danger">
                            @if($Player->user->picture)
                        <td><img src="{{$Player->user->picture}}" width="60" height="60" class="img-rounded"/></td>
                            @else
                                <td><img src="images/Users/default.gif" width="60" height="60" class="img-rounded"/></td>
                            @endif
                        <td>{{$Player->user->name}}</td>
                        <td>{{$Player->school}}</td>
                        <td>{{$Player->user->birth}}</td>
                        <td>{{$Player->user->phone}}</td>
                        <td>{{$Player->user->address}}</td>
                        <td>
                            @if($Player->user->facebook )
                                {{$Player->user->facebook}}
                            @endif
                        </td>
                        <td>
                            @if($Player->subscription)
                                <label class="text-success">Active</label>
                                @else
                                <label class="text-danger">Non Active</label>
                                @endif
                        </td>
                        <td>
                            <a href="{{"/player/$Player->id/{$Player->user->name}"}}"><i class="fa fa-info"></i></a>
                            <i class="fa fa-close white DeletePlayer" data-id="{{$Player->id}}" data-popup="delete-player-popup"></i>
                        </td>
                    </tr>

                        @endforeach
                    </tbody>
                </table> <!-- table -->
            </div> <!-- end players table -->
            <div class="text-center pagination">

            </div>

        </div> <!-- End tab players -->
    @endsection
@section('script')

    <script src="{{ asset('Ajax/Players.js')}}"></script>

@endsection