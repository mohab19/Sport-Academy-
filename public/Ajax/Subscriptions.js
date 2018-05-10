function GetPlayerInfo()
{
    waiting();
    $.ajax({
        url:"/subscription/player_info",
        type:"POST",
        data: $('#AddSubscription').serialize(),
        dataType: "html",   //expect html to be returned
        success:function(data){
            // alert(data);
            $("#private").append(data);
            var player_place_id = $("#private input[name='place_id']").val();
            var player_level_id = $("#private input[name='level_id']").val() ;
            $("#AddSubscription select[name='place_id']").val(player_place_id);
            $("#AddSubscription select[name='level_id']").val(player_level_id);
            if(player_place_id>0 && player_level_id>0)
            {
                var PlaceName = $("#AddSubscription select[name='place_id'] option[value="+player_place_id+"]").text();
                $("div b#place").text(PlaceName);
                GetSchedules();
                GetTeamSchedules();
                GetPrice();
            }
            finish();
        },
        error:function(data){
            reload(data);
         // tellme(data)
        }
    });
}
function GetSchedules()
{
    waiting();
    $.ajax({
        url:"/subscription/schedules",
        type:"POST",
        data: $('#AddSubscription').serialize(),
        dataType: "html",   //expect html to be returned
        success:function(data){
            // alert(data);
            $("#AddSubscription div.schedules").html(data);
            finish();
        },
        error:function(data){
            reload(data);
         // tellme(data)
        }
    });
}
function GetTeamSchedules ()
{
    waiting();
    $.ajax({
        url:"/subscription/team_schedules",
        type:"POST",
        data: $('#AddSubscription').serialize(),
        dataType: "html",   //expect html to be returned
        success:function(data){
            // alert(data);
            $("#AddSubscription div.teams_schedules").html(data);
            finish();
        },
        error:function(data){
            reload(data);
         // tellme(data)
        }
    });
}
function GetPrice()
{
    waiting();
    $.ajax({
        url: '/subscription/calculate',
        type: 'POST',
        data: $('#AddSubscription').serialize(),
        success: function (data) {
            if (data) {
              //  alert(data['required']);
                $('b#RequiredMoney').html(data['required']);
            }
            finish();
        },
        error:function(data){
            reload(data);
         // tellme(data)
        }
    });
}
$(function () {
    var SubscriptionID = $("#private input[name='subscription_id']").val();
    var LevelID;
    var PlaceID;
    $("#AddSubscription select[name='place_id']").change(function () {
        PlaceID = $(this).val();


    });
    $("#AddSubscription select[name='level_id']").change(function () {
        LevelID = $(this).val();
        GetSchedules();
        GetTeamSchedules();
        GetPrice();

    });
    $("#UpdateSubscription select[name='place_id']").change(function () {
        waiting();
         PlaceID = $(this).val();
        $.ajax({
            url:"/subscription/place/"+PlaceID+"/schedule",
            type:"POST",
            data:{_token: $('#UpdateSubscription input[name="_token"]').val()},
            dataType: "html",   //expect html to be returned
            success:function(data){
              // alert(data);
                $("#UpdateSubscription div.schedules").html(data);
                finish();
            },
            error:function(data){reload(data); //tellme(data)
              // alert(data['responseText']);



            }
        });
    });
    $("#AddSubscription select[name='extras_id[]']").change(function(){
        GetPrice();
    });
    $('#AddSubscription').submit(function (e) {
        e.preventDefault();
        var button = $('#AddSubscription button[type="submit"]');
        button_waiting(button);
        var total = parseFloat($("#AddSubscription #RequiredMoney").text());
        var paid = parseFloat($('#AddSubscription input[name="paid"]').val());
        var discount = parseFloat($('#AddSubscription input[name="discount"]').val());
        if(paid>(total-discount))
        {
            button_done(button);
            PrintOnSelector("div.error div.alert","Enter Paid Correctly");
            $("div.error div.alert").removeClass('alert-success').addClass('alert-danger');
            $("div.error").show();
        }
        else {
            $("div.error").hide();
            $.ajax({
                url: '/subscription/add',
                type: 'POST',
                data: $("#AddSubscription").serialize(),
                success: function (data) {
                  // alert(data);
                    button_done(button);
                    if (data == 0) {
                        PrintOnSelector('#AddSubscription>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#AddPlayer>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });

                    }
                    else {
                        PrintOnSelector('div.error div.alert', "Subscription Added Successfully");
                        $("div.error div.alert").removeClass("alert-danger").addClass("alert-success");
                        $("div.error").show(function () {
                            //alert(data);
                            $(this).delay(1000).fadeOut(function () {
                                w = window.open('','newtab'); d = w.document.open("text/html","replace");

                                d.writeln(data);
                                location.href="/subscription/add";
                            });
                        });
                    }
                },
                error:function(data){
                    reload(data);
                  //tellme(data);
                    var error = data.responseJSON;
                    button_done(button);
                    $("#AddSubscription label.alert").addClass("alert-danger").fadeIn();
                    error_handler(
                        error,
                        ['#AddSubscription #player_id',
                            '#AddSubscription #level_id',
                            '#AddSubscription #place_id',
                            '#AddSubscription #coach_id',
                            '#AddSubscription #paid'

                        ],
                        ['player_id',
                            'level_id',
                            'place_id',
                            'coach_id',
                            'paid'
                        ]
                    );
                }
            });
        }
    });
    $("#DeleteSubscription").submit(function(e){
        var button = $('#DeleteSubscription button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/subscription/"+SubscriptionID+"/delete",
            type:"POST",
            data:$("#DeleteSubscription").serialize(),
            success:function(data){
                // alert(data);
                button_done(button);
                $("#DeleteSubscription label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteSubscription>div.alert', "Subscription Deleted Successfully");
                    $("#DeleteSubscription>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteSubscription>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeletePlayer>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
              // alert(data['responseText']);



                PrintOnSelector('#DeleteSubscription>div.alert', "Cannot Delete This Subscription");
                $("#DeleteSubscription>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn();
            }
        });
    })
    $(".UpdateSubscription").click(function(){
        var SubscriptionID = $(this).attr("data-id");
        var SubscriptionPlace = $.trim($(this).siblings("div#place").text());
        var SubscriptionCoach = $.trim($(this).siblings("div#coach").text());
        $("#UpdateSubscription input.hidden").val(SubscriptionID);
        $("#UpdateSubscription select.place").val(SubscriptionPlace);
        $("#UpdateSubscription select.coach").val(SubscriptionCoach);


    })
    $("#UpdateSubscription").submit(function(e){
        var button = $('#UpdateSubscription button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/subscription/"+SubscriptionID+"/update",
            type:"POST",
            data:$("#UpdateSubscription").serialize(),
            success:function(data){
              // alert(data);
                button_done(button);
                $("#UpdateSubscription label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdateSubscription>div.alert', "Subscription Updated Successfully");
                    $("#UpdateSubscription>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateSubscription>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateSubscription>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data);
           // tellme(data)
               // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#UpdateSubscription label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    ['#UpdateSubscription #subscription_schedule'

                    ],
                    ['schedules_id'
                    ]
                );
            }
        });
    })
    var SubID;
    $(".PaySubscription").click(function(){
        SubID = $(this).attr("data-id");
    })
    $("#PaySubscription").submit(function(e){
        var button = $('#PaySubscription button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/subscription/"+SubID+"/debt",
            type:"POST",
            data:$("#PaySubscription").serialize(),
            success:function(data){
                alert(data);
                button_done(button);
                $("#PaySubscription label.alert").fadeOut();
                 if(data == 2)
                {
                    PrintOnSelector('#PaySubscription>div.alert', "Enter the value correctly");
                    $("#PaySubscription>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    });
                }
               else
                {
                    PrintOnSelector('#PaySubscription>div.alert', "Subscription Paid Successfully");
                    $("#PaySubscription>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            w = window.open('','newtab'); d = w.document.open("text/html","replace");

                            d.writeln(data);
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data);
              //tellme(data)
                button_done(button);
                // alert(data['responseText']);
                var error = data.responseJSON;
                $("#PaySubscription label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#PaySubscription #Player_paid'

                    ],
                    [
                        'paid'

                    ]
                );
            }
        });
    })
    $(".RenewSubscription").click(function(){
        SubID = $(this).attr("data-id");
        $("#RenewSubscription input[name='id']").val(SubID);
    })
    $("#RenewSubscription").submit(function(e){
        var button = $('#RenewSubscription button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/subscription/renew",
            type:"POST",
            data:$("#RenewSubscription").serialize(),
            success:function(data){
                alert(data);
                button_done(button);
                $("#RenewSubscription label.alert").fadeOut();
                 if(data == 2)
                {
                    PrintOnSelector('#RenewSubscription>div.alert', "Enter the value correctly");
                    $("#RenewSubscription>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    });
                }
               else
                {
                    PrintOnSelector('#RenewSubscription>div.alert', "Subscription Renewed Successfully");
                    $("#RenewSubscription>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            w = window.open('','newtab'); d = w.document.open("text/html","replace");

                            d.writeln(data);
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data);
              tellme(data)
                button_done(button);
                // alert(data['responseText']);
                var error = data.responseJSON;
                $("#RenewSubscription label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#RenewSubscription #Subscription_paid'

                    ],
                    [
                        'paid'

                    ]
                );
            }
        });
    })
});