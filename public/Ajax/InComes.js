$("#AddInCome").submit(function(e){
    var button = $('#AddInCome button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/income/add",
        type:"POST",
        data:$("#AddInCome").serialize(),
        success:function(data){
            //alert(data);
            button_done(button);
            $("#AddInCome label.alert").fadeOut();
            if(data != 1)
            {
                PrintOnSelector('#AddInCome>div.alert', "InCome Added Successfully");
                $("#AddInCome>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        w = window.open('','newtab'); d = w.document.open("text/html","replace");
                        d.writeln(data);
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddInCome>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddInCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){
            reload(data);
            // tellme(data);
            button_done(button);
            var error = data.responseJSON;
            $("#AddInCome label.alert").fadeIn().addClass("alert-danger");
            error_handler(
                error,
                [
                    '#AddInCome #income_place',
                    '#AddInCome #income_title',
                    '#AddInCome #income_value'
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
var InComeID;
$(".UpdateInComeButton").click(function(){

    InComeID = $(this).attr("data-id");
    $("#UpdateInCome  input[name='title']").val($.trim($(this).parent().siblings("td#title").text()));
    $("#UpdateInCome input[name='value']").val($.trim($(this).parent().siblings("td#value").text()));
})
$("#UpdateInCome").submit(function(e){
    var button = $('#UpdateInCome button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/income/"+InComeID+"/update",
        type:"POST",
        data:$("#UpdateInCome").serialize(),
        success:function(data){
            // alert(data);
            button_done(button);
            $("#UpdateInCome label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#UpdateInCome>div.alert', "InCome Updated Successfully");
                $("#UpdateInCome>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#UpdateInCome>div.alert', "Unexpected Error Come , Please Try Again");
                $("#UpdateInCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            var error = data.responseJSON;
            $("#UpdateInCome label.alert").addClass("alert-danger").fadeIn();
            // alert(data['responseText']);
            //
            //
            //
            error_handler(
                error,
                [
                    '#UpdateInCome #income_title',
                    '#UpdateInCome #income_value',
                ],
                [
                    'title',
                    'value',
                ]
            );
        }
    });
})
$(".DeleteInComeButton").click(function(){
    InComeID = $(this).attr("data-id");
})
$("#DeleteInCome").submit(function(e){
    var button = $('#DeleteInCome button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"income/"+InComeID+"/delete",
        type:"POST",
        data:$("#DeleteInCome").serialize(),
        success:function(data){
          // alert(data);
            button_done(button);
                $("#DeleteInCome label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#DeleteInCome>div.alert', "InCome Deleted Successfully");
                $("#DeleteInCome>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#DeleteInCome>div.alert', "Unexpected Error Come , Please Try Again");
                $("#DeleteInCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            //alert(data['responseText']);
            PrintOnSelector('#DeleteInCome>div.alert', "Cannot Delete This InCome");
            $("#DeleteInCome>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                $(this).delay(1000).fadeOut(function () {
                    location.reload();
                });
            });
        }
    });
})
