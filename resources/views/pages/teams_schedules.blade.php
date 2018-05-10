@extends('layouts.dashboard')

@section('style')


@endsection

@section('title')
    Team Schedules
@endsection

@section('tab')

    @foreach($places as $place)
        <a href="/team/schedule/place/{{str_replace(' ', '-', $place->name)}}"><button class="main-button">{{$place->name}}</button></a>
        <div class="clearfix"></div>
    @endforeach
@endsection

@section('script')
    <script>
        $("button#AddTimeButton").click(function(){
            var data = '<div class="time col-xs-12"> <div class="col-md-4"> <select name="day[]"> <option disabled selected value="">Day</option> <option value="Saturday">Saturday</option> <option value="Sunday">Sunday</option> <option value="Monday">Monday</option> <option value="Tuesday">Tuesday</option> <option value="Wednesday">Wednesday</option> <option value="Thursday">Thursday</option> <option value="Friday">Friday</option> </select></div> <div class="col-md-4"> <input type="time" placeholder="From" name="from[]"> </div> <div class="col-md-4"> <input type="time" placeholder="To" name="to[]"> </div> </div>';
            $(this).before(data)
        });
    </script>
    <script>
        $("#SearchScheduleInput").keyup(function(){
            var filter = $(this).val();
            $(".Schedules .Schedule .name").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().parent().hide(400);
                } else {
                    $(this).parent().parent().show(400);
                }
            });
        });
    </script>

    <script></script>
    <script src="{{ asset('Ajax/TeamsSchedules.js')}}"></script>
@endsection