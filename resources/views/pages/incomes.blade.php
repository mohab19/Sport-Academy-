@extends('layouts.dashboard')

@section('style')

    <style>
    </style>
@endsection

@section('title')
    Extra InComes
@endsection

@section('tab')

    @include('forms.incomes.add')
    @include('forms.incomes.update')
    @include('forms.incomes.delete')
    <button class="main-button AddInComeButton AddButton" data-popup="add-income-popup">+</button>
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
                    <th>
                        Place
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Options
                    </th>
            </tr>
            </thead> <!-- main row -->
            <tbody>
            @foreach($incomes as $income)
                <tr class="danger">
                    <td id="title">
                        {{$income->title}}
                    </td>
                    <td id="value">
                        {{$income->value}}
                    </td>
                    <td>
                        {{$income->place->name}}
                    </td>
                    <td>
                        {{$income->date}}
                    </td>
                    <td>
                        <i class="fa fa-pencil white UpdateInComeButton"data-id="{{$income->id}}" data-popup="update-income-popup"></i>
                        <i class="fa fa-close white DeleteInComeButton"data-id="{{$income->id}}" data-popup="delete-income-popup"></i>
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
    <script src="{{ asset('Ajax/InComes.js')}}"></script>
@endsection