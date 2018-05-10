$(function () {
    function GetCoaches() {
        $.ajax({
            url:"/schedule/coaches/place/"+Place_ID,
            type:"POST",
            data:{_token: $('#AddSchedule input[name="_token"]').val()},
            dataType: "html",   //expect html to be returned
            success:function(data){
                // alert(data);
                $("#AddSchedule label.alert").fadeOut();
                $("#AddSchedule select[name='coach_id'] option[value!='']").remove();
                $("#AddSchedule select[name='coach_id']").append(data);
            },
            error:function(data){reload(data);//tellme(data)
                //alert(data['responseText']);
            }
        });
    }
    function GetPlaygrounds() {
        $.ajax({
            url:"/schedule/playgrounds/place/"+Place_ID,
            type:"POST",
            data:{_token: $('#AddSchedule input[name="_token"]').val()},
            dataType: "html",   //expect html to be returned
            success:function(data){
              //  alert(data);
                $("#AddSchedule label.alert").fadeOut();
                $("#AddSchedule select[name='playground_id'] option[value!='']").remove();
                $("#AddSchedule select[name='playground_id']").append(data);
            },
            error:function(data){
                reload(data);
              //tellme(data);
                //alert(data['responseText']);
            }
        });
    }
    var Place_ID;
    var Day_ID;
    $(".AddScheduleButton").click(function () {
        $("#AddSchedule input[name='day_id']").val($(this).attr('data-day'));
    });
    $('#AddSchedule').submit(function (e) {
        var button = $('#AddSchedule button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/schedule/add',
            type: 'POST',
            data:$("#AddSchedule").serialize(),
            success: function (data) {
                $("#AddSchedule label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddSchedule>div.alert', "Schedule Added Successfully");
                    $("#AddSchedule>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddSchedule>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddSchedule>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data);
            tellme(data)
                 //alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#AddSchedule label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddSchedule #schedule_from',
                        '#AddSchedule #schedule_to'
                    ],
                    [
                        'from',
                        'to'
                    ]
                );
            }
        });
    });
});