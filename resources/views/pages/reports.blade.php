@extends('layouts.dashboard')

@section('style')

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <style>
        div.box
        {
            display: none;
        }
        .info td
        {
            color:#fff;
        }
        table td a
        {
            color:#5356a5 !important;
        }
    </style>
@endsection

@section('title')
    Reports
    @endsection

    @section('tab')
        <div role="tabpanel" class="tab-pane text-center active" id="home">
            <form id="Report">
                {{--{!! csrf_field() !!}--}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-3">
                    <select name="type">
                        <option value="">Type</option>
                        @foreach($user->reports as $report)
                            <option value="{{$report->report->value}}">{{$report->report->title}}</option>
                        @endforeach
                    </select>
                    <label id="Report_type" class="alert text-center"></label>
                </div>
                <div class="col-md-3 places">
                    <select name="place_id">
                        <option value="">Place</option>
                        <option value="all">All Places</option>
                        @foreach($places as $place)
                            <option value="{{$place->id}}">{{$place->name}}</option>
                        @endforeach
                    </select>
                    <label id="Report_place" class="alert text-center"></label>
                </div>
                <div class="col-md-3 months">
                    <select name="month">
                        <option value="">Month</option>
                        <option value="all">All Months</option>
                    </select>
                <label id="Report_month" class="alert text-center"></label>

                </div>

                <div class="col-md-3 years">
                    <select name="year">
                        <option value="">Year</option>
                        <option value="all">All Years</option>
                    </select>
                <label id="Report_year" class="alert text-center"></label>
                </div>
                <br>
                <div class="clearfix"></div>
                <div class="text-center">
                    <button class="main-button" type="submit">Generate Report</button>
                </div>
            </form>
            <div class="clearfix"></div>
            <div class="box box-lg">
                <h3 class="title rose text-left">Report Results</h3>
                <div class="results">

                </div>
            </div>
        </div>
    @endsection
@section('script')

    <script src="{{ asset('Ajax/reports.js')}}"></script>

@endsection