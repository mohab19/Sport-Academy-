@extends('layouts.dashboard')

@section('style')

    <style>

    </style>
@endsection

@section('title')
    Groups
@endsection

@section('tab')

    @include('forms.groups.add')
    <h3 class="text-center" style="text-transform: none;margin-top: 120px">
<span>
    Come back soon , we will return with our Android & IOS Application
</span>
    </h3>
    <p class="text-center" style="font-size:18px;">- Killing Shot Squash Academy <i class="fa fa-heart purple"></i> -</p>
    {{--<button class="main-button AddNewsButton AddButton" data-popup="add-group-popup">+</button>--}}
    {{--<table class="table text-center">--}}
        {{--<thead> <!-- main row -->--}}
        {{--<tr class="info">--}}
                {{--<th>--}}
                    {{--Name--}}
                {{--</th>--}}
                {{--<th>--}}
                    {{--Owner--}}
                {{--</th>--}}
                {{--<th>--}}
                    {{--Users--}}
                {{--</th>--}}
            {{--<th>--}}
                {{--Options--}}
            {{--</th>--}}

        {{--</tr>--}}
        {{--</thead> <!-- main row -->--}}
        {{--<tbody>--}}
        {{--@foreach($groups as $group)--}}
            {{--<tr class="danger">--}}
                {{--<td>--}}
                    {{--{{$group->name}}--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--{{$group->owner->name}}--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--{{$group->group_users->count()}}--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--<a href="{{"/group/$group->id/{$group->name}"}}"><i class="fa fa-info"></i></a>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table> <!-- table -->--}}
@endsection
@section('script')
    <script>
    </script>
    <script src="{{ asset('Ajax/Groups.js')}}"></script>
@endsection