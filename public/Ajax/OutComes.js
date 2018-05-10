$("#AddOutCome").submit(function(e){
    var button = $('#AddOutCome button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/outcome/add",
        type:"POST",
        data:$("#AddOutCome").serialize(),
        success:function(data){
            //alert(data);
            button_done(button);
            $("#AddOutCome label.alert").fadeOut();
            if(data != 1)
            {
                PrintOnSelector('#AddOutCome>div.alert', "OutCome Added Successfully");
                $("#AddOutCome>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        w = window.open('','newtab'); d = w.document.open("text/html","replace");

                        d.writeln(data);
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddOutCome>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddOutCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){



            reload(data); //tellme(data)
            button_done(button);
          // alert(data['responseText']);
            var error = data.responseJSON;
            $("#AddOutCome label.alert").fadeIn().addClass("alert-danger");
            error_handler(
                error,
                [
                    '#AddOutCome #outcome_place',
                    '#AddOutCome #outcome_title',
                    '#AddOutCome #outcome_value'
                ],
                [
                    'place_id',
                    'title',
                    'value'
                ]
            );
        }
    });
})
var OutComeID;
$(".UpdateOutComeButton").click(function(){

    OutComeID = $(this).attr("data-id");
    $("#UpdateOutCome input[name='title']").val($.trim($(this).parent().siblings("td#title").text()));
    $("#UpdateOutCome input[name='value']").val($.trim($(this).parent().siblings("td#value").text()));
})
$("#UpdateOutCome").submit(function(e){
    var button = $('#UpdateOutCome button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/outcome/"+OutComeID+"/update",
        type:"POST",
        data:$("#UpdateOutCome").serialize(),
        success:function(data){
            // alert(data);
            button_done(button);
            $("#UpdateOutCome label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#UpdateOutCome>div.alert', "OutCome Updated Successfully");
                $("#UpdateOutCome>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#UpdateOutCome>div.alert', "Unexpected Error Come , Please Try Again");
                $("#UpdateOutCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            var error = data.responseJSON;
            $("#UpdateOutCome label.alert").addClass("alert-danger").fadeIn();
            // alert(data['responseText']);
            //
            //
            //
            error_handler(
                error,
                [
                    '#UpdateOutCome #outcome_title',
                    '#UpdateOutCome #outcome_value',
                ],
                [
                    'title',
                    'value',
                ]
            );
        }
    });
})
$(".DeleteOutComeButton").click(function(){
    OutComeID = $(this).attr("data-id");
})
$("#DeleteOutCome").submit(function(e){
    var button = $('#DeleteOutCome button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"outcome/"+OutComeID+"/delete",
        type:"POST",
        data:$("#DeleteOutCome").serialize(),
        success:function(data){
          // alert(data);
            button_done(button);
                $("#DeleteOutCome label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#DeleteOutCome>div.alert', "OutCome Deleted Successfully");
                $("#DeleteOutCome>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#DeleteOutCome>div.alert', "Unexpected Error Come , Please Try Again");
                $("#DeleteOutCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            //alert(data['responseText']);
            PrintOnSelector('#DeleteOutCome>div.alert', "Cannot Delete This OutCome");
            $("#DeleteOutCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                $(this).delay(1000).fadeOut(function () {
                    location.reload();
                });
            });
        }
    });
})
