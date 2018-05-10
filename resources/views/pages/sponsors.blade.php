@extends('layouts.dashboard')

@section('style')

    <style>
    .sponsor
    {
        text-align: center;
    }
        .sponsor img
        {
            width:100%;
            height: 100%;
        }
        .sponsor .image
        {
            height: 80%;
            width: 80%;
        }
    </style>
@endsection

@section('title')
    Sponsors
@endsection

@section('tab')

    @include('forms.sponsors.add')
    @include('forms.sponsors.delete')
    <button class="main-button AddProductButton AddButton" data-popup="add-sponsor-popup">+</button>
    <div class="sponsors">
        @foreach($sponsors as $sponsor)
            <div class="sponsor col-md-3">
                <div class="image">
                    <img  src="{{$sponsor->picture}}" alt="">
                </div>
                <div class="text-center">
                    <button class="main-button DeleteSponsorButton" data-id="{{$sponsor->id}}" data-popup="delete-sponsor-popup">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script>
    </script>
    <script src="{{ asset('Ajax/Sponsors.js')}}"></script>
@endsection