@extends('layouts.dashboard')

@section('style')

    <style>
    </style>
@endsection

@section('title')
    Extra OutComes
@endsection

@section('tab')

    @include('forms.outcomes.add')
    @include('forms.outcomes.update')
    @include('forms.outcomes.delete')
    <button class="main-button AddOutComeButton AddButton" data-popup="add-outcome-popup">+</button>
    <div class="col-md-12 box-lg"> <!-- start players table -->
        <table class="table text-center">
            <thead> <!-- main row -->
            <tr class="info">
                    <th>
                        Title
                    </th>
                    <th>
                        Value
                    </th>
                    {{--<th>--}}
                        {{--Place--}}
                    {{--</th>--}}
                    <th>
                        Date
                    </th>
                    <th>
                        Options
                    </th>
            </tr>
            </thead> <!-- main row -->
            <tbody>
            @foreach($outcomes as $outcome)
                <tr class="danger">
                    <td id="title">
                        {{$outcome->title}}
                    </td>
                    <td id="value">
                        {{$outcome->value}}
                    </td>
                    {{--<td>--}}
                        {{--{{$outcome->place->name}}--}}
                    {{--</td>--}}
                    <td>
                        {{$outcome->date}}
                    </td>
                    <td>
                        <i class="fa fa-pencil white UpdateOutComeButton"data-id="{{$outcome->id}}" data-popup="update-outcome-popup"></i>
                        <i class="fa fa-close white DeleteOutComeButton"data-id="{{$outcome->id}}" data-popup="delete-outcome-popup"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table> <!-- table -->
    </div>
@endsection
@section('script')
    <script>
    </script>
    <script src="{{ asset('Ajax/OutComes.js')}}"></script>
@endsection