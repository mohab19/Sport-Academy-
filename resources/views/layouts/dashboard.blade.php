@extends('layouts.master')
@section('style')

@endsection

@section('title')
    Control Panel
@endsection

@section('contents')
    <div id="control-panel"> <!-- Star Control Panel -->
        <div>
            @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
            {{-- Menu loads here--}}
            @include('layouts.menu')
            @else
                @include('layouts.panelheader')
            @endif
                @yield('posts-tabs')
            <div class="container-fluid">
                <div class="tab-content">
                    @yield('tab')
                </div>


            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection




