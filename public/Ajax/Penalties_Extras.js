var UserID = $("#private #UserID").val();
$("#AddPenalty").submit(function(e){
    var button = $('#AddPenalty button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/"+UserID+"/penalty/add",
        type:"POST",
        data:$("#AddPenalty").serialize(),
        success:function(data){
            //alert(data);
            button_done(button);
            $("#AddPenalty label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#AddPenalty>div.alert', "Penalty Added Successfully");
                $("#AddPenalty>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddPenalty>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddPenalty>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
          // alert(data['responseText']);
            var error = data.responseJSON;
            $("#AddPenalty label.alert").fadeIn().addClass("alert-danger");
            error_handler(
                error,
                [
                    '#AddPenalty #penalty_title',
                    '#AddPenalty #penalty_value'
                ],
                [
                    'title',
                    'value'
                ]
            );
        }
    });
})
var PenaltyID;
$(".UpdatePenaltyButton").click(function(){
    PenaltyID = $(this).attr("data-id");
    $("#UpdatePenalty input[name='title']").val($("#penalties-table td#title").text());
    $("#UpdatePenalty input[name='value']").val($("#penalties-table td#value").text());
})
$("#UpdatePenalty").submit(function(e){
    var button = $('#UpdatePenalty button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/penalty/"+PenaltyID+"/update",
        type:"POST",
        data:$("#UpdatePenalty").serialize(),
        success:function(data){
            // alert(data);
            button_done(button);
            $("#UpdatePenalty label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#UpdatePenalty>div.alert', "Penalty Updated Successfully");
                $("#UpdatePenalty>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#UpdatePenalty>div.alert', "Unexpected Error Come , Please Try Again");
                $("#UpdatePenalty>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            var error = data.responseJSON;
            $("#UpdatePenalty label.alert").addClass("alert-danger").fadeIn();
          // alert(data['responseText']);
            error_handler(
                error,
                [
                    '#UpdatePenalty #penalty_title',
                    '#UpdatePenalty #penalty_value',
                ],
                [
                    'title',
                    'value',
                ]
            );
        }
    });
})
$(".DeletePenaltyButton").click(function(){
    PenaltyID = $(this).attr("data-id");
})
$("#DeletePenalty").submit(function(e){
    var button = $('#DeletePenalty button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/penalty/"+PenaltyID+"/delete",
        type:"POST",
        data:$("#DeletePenalty").serialize(),
        success:function(data){
          // alert(data);
            button_done(button);
            $("#DeletePenalty label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#DeletePenalty>div.alert', "Penalty Deleted Successfully");
                $("#DeletePenalty>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#DeletePenalty>div.alert', "Unexpected Error Come , Please Try Again");
                $("#DeletePenalty>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            //alert(data['responseText']);
            PrintOnSelector('#DeletePenalty>div.alert', "Cannot Delete This Penalty");
            $("#DeletePenalty>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                $(this).delay(1000).fadeOut(function () {
                    location.reload();
                });
            });
        }
    });
})
$("#AddExtra").submit(function(e){
    var button = $('#AddExtra button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/"+UserID+"/extra/add",
        type:"POST",
        data:$("#AddExtra").serialize(),
        success:function(data){
            //alert(data);
            button_done(button);
            $("#AddExtra label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#AddExtra>div.alert', "Extra Added Successfully");
                $("#AddExtra>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddExtra>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            // alert(data['responseText']);
            var error = data.responseJSON;
            $("#AddExtra label.alert").fadeIn().addClass("alert-danger");
            error_handler(
                error,
                [
                    '#AddExtra #extra_title',
                    '#AddExtra #extra_value'
                ],
                [
                    'title',
                    'value'
                ]
            );
        }
    });
})
var ExtraID;
$(".UpdateExtraButton").click(function(){
    ExtraID = $(this).attr("data-id");
    $("#UpdateExtra input[name='title']").val($("#extras-table td#title").text());
    $("#UpdateExtra input[name='value']").val($("#extras-table td#value").text());
})
$("#UpdateExtra").submit(function(e){
    var button = $('#UpdateExtra button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/extra/"+ExtraID+"/update",
        type:"POST",
        data:$("#UpdateExtra").serialize(),
        success:function(data){
            // alert(data);
            button_done(button);
            $("#UpdateExtra label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#UpdateExtra>div.alert', "Extra Updated Successfully");
                $("#UpdateExtra>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#UpdateExtra>div.alert', "Unexpected Error Come , Please Try Again");
                $("#UpdateExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            var error = data.responseJSON;
            $("#UpdateExtra label.alert").addClass("alert-danger").fadeIn();
          // alert(data['responseText']);
            error_handler(
                error,
                [
                    '#UpdateExtra #extra_title',
                    '#UpdateExtra #extra_value',
                ],
                [
                    'title',
                    'value',
                ]
            );
        }
    });
})
$(".DeleteExtraButton").click(function(){
    ExtraID = $(this).attr("data-id");
})
$("#DeleteExtra").submit(function(e){
    var button = $('#DeleteExtra button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/extra/"+ExtraID+"/delete",
        type:"POST",
        data:$("#DeleteExtra").serialize(),
        success:function(data){
          // alert(data);
            button_done(button);
            $("#DeleteExtra label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#DeleteExtra>div.alert', "Extra Deleted Successfully");
                $("#DeleteExtra>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#DeleteExtra>div.alert', "Unexpected Error Come , Please Try Again");
                $("#DeleteExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            //alert(data['responseText']);
            PrintOnSelector('#DeleteExtra>div.alert', "Cannot Delete This Extra");
            $("#DeleteExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                $(this).delay(1000).fadeOut(function () {
                    location.reload();
                });
            });
        }
    });
})
