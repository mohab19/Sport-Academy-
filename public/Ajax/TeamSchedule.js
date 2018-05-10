    $(function () {
        var ScheduleID = $("div#private>input#ScheduleID").val();
        $("#UpdateSchedule").submit(function(e){
            var button = $('#UpdateSchedule>div>button');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url:"/team/schedule/"+ScheduleID+"/update",
                type:"POST",
                data : new FormData(this),
                contentType: false,
                cache      : false,
                processData: false,
                success:function(data){
                 // alert(data);
                    button_done(button);
                    $("#UpdateSchedule label.alert").fadeOut();
                    if(data == 1)
                    {
                        PrintOnSelector('#UpdateSchedule>div.alert', "Schedule Updated Successfully");
                        $("#UpdateSchedule>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                            });
                        });
                    }
                    else {
                        PrintOnSelector('#UpdateSchedule>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#UpdateSchedule>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                },
                error:function(data){reload(data);
                tellme(data)
                    button_done(button);
                    // alert(data['responseText']);
                    //
                    //
                    //
                    var error = data.responseJSON;
                    $("#UpdateSchedule label.alert").addClass("alert-danger").fadeIn();
                    PrintOnSelector('#UpdateSchedule>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateSchedule>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            });
        })
        $("#DeleteSchedule").submit(function(e){
            var button = $('#DeleteSchedule button');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url:"/team/schedule/"+ScheduleID+"/delete",
                type:"POST",
                data:$("#DeleteSchedule").serialize(),
                success:function(data){
                     // alert(data);
                    button_done(button);
                    $("#DeleteSchedule label.alert").fadeOut();
                    if(data == 1)
                    {
                        PrintOnSelector('#DeleteSchedule>div.alert', "Schedule Deleted Successfully");
                        $("#DeleteSchedule>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                back();
                            });
                        });
                    }
                    else {
                        PrintOnSelector('#DeleteSchedule>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#DeleteSchedule>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                },
                error:function(data){reload(data); //tellme(data)
                    button_done(button);
                  // alert(data['responseText']);
                    PrintOnSelector('#DeleteSchedule>div.alert', "Cannot Delete This Schedule");
                    $("#DeleteSchedule>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            });
        })
    });