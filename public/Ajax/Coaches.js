$(function () {

    $('#AddType').submit(function (e) {
        var button = $('#AddType button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/coach/type/add',
            type: 'POST',
            data: $('#AddType').serialize(),
            success: function (data) {
                $("#AddType label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddType>div.alert', "Type Added Successfully");
                    $("#AddType>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddType>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddType>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data); //tellme(data)
                  // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#AddType label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddType #Type_name'
                    ],
                    [   'name'
                    ]
                );
            }
        });
    });
    $(".DeleteType").click(function(){
        var TypeID = $(this).attr("data-id");
        $("#DeleteType input.hidden").val(TypeID);
    })
    $("#DeleteType").submit(function(e){
        var button = $('#DeleteType button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/coach/type/delete',
            type:"POST",
            data:$("#DeleteType").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteType label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteType>div.alert', "Type Deleted Successfully");
                    $("#DeleteType>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteType>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteType>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                 //alert(data['responseText']);
                PrintOnSelector('#DeleteType>div.alert', "Cannot Delete This Type");
                $("#DeleteType>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $('#AddCoach').submit(function (e) {
        var button = $('#AddCoach button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/coach/add',
            type:"POST",
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                 // alert(data);
                $("#AddCoach label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddCoach>div.alert', "Coach Added Successfully");
                    $("#AddCoach>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddCoach>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddCoach>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data); //tellme(data)
               // alert(data['responseText']);
               //
               //
               //
                var error = data.responseJSON;
                button_done(button);
                $("#AddCoach label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddCoach #Coach_fullname',
                        '#AddCoach #Coach_phone',
                        '#AddCoach #Coach_address',
                        '#AddCoach #Coach_birthdate',
                        '#AddCoach #Coach_salary',
                        '#AddCoach #Coach_email',
                        '#AddCoach #Coach_username',
                        '#AddCoach #Coach_password',
                        '#AddCoach #Coach_places',
                        '#AddCoach #Coach_type'
                    ],
                    [   'full_name',
                        'phone',
                        'address',
                        'birthdate',
                        'salary',
                        'email',
                        'username',
                        'password',
                        'places_id',
                        'type_id'
                    ]
                );
            }
        });
    });
    $(".DeleteCoach").click(function(){
        var CoachID = $(this).attr("data-id");
        // alert(CoachID);
        $("#DeleteCoach input.hidden").val(CoachID);
    })
    $("#DeleteCoach").submit(function(e){
        var button = $('#DeleteCoach button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/coach/delete",
            type:"POST",
            data:$("#DeleteCoach").serialize(),
            success:function(data){
                // alert(data);
                // alert(data['responseText']);
                button_done(button);
                $("#DeleteCoach label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteCoach>div.alert', "Coach Deleted Successfully");
                    $("#DeleteCoach>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteCoach>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteCoach>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                 // alert(data['responseText']);
                PrintOnSelector('#DeleteCoach>div.alert', "Cannot Delete This Coach");
                $("#DeleteCoach>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $(".UpdateCoach").click(function(){
        var CoachID = $(this).attr("data-id");
        var CoachFirstName = $.trim($(this).parent().siblings("td#firstname").text());
        var CoachLastName = $.trim($(this).parent().siblings("td#lastname").text());
        var CoachBirthdate = $.trim($(this).parent().siblings("td#birthdate").text());
        var CoachPhone = $.trim($(this).parent().siblings("td#phone").text());
        var CoachAddress = $.trim($(this).parent().siblings("td#address").text());
        var CoachEmail = $.trim($(this).parent().siblings("td#email").text());
        var CoachSalary = $.trim($(this).parent().siblings("td#salary").text());
        var CoachType = $.trim($(this).parent().siblings("td#type").text());
        var CoachFacebook = $.trim($(this).parent().siblings("td#facebook").children('a').attr('href'));
        $("#UpdateCoach input.hidden").val(CoachID);
        $("#UpdateCoach input.Firstname").val(CoachFirstName);
        $("#UpdateCoach input.Lastname").val(CoachLastName);
        $("#UpdateCoach input.Birthdate").val(CoachBirthdate);
        $("#UpdateCoach input.Phone").val(CoachPhone);
        $("#UpdateCoach input.Address").val(CoachAddress);
        $("#UpdateCoach input.Email").val(CoachEmail);
        $("#UpdateCoach input.Salary").val(CoachSalary);
        $("#UpdateCoach select").val(CoachType);
        $("#UpdateCoach input.Facebook").val(CoachFacebook);

        // alert(CoachSalary);
    })
    $("#UpdateCoach").submit(function(e){
        var button = $('#UpdateCoach button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/coach/update",
            type:"POST",
            data:$("#UpdateCoach").serialize(),
            success:function(data){
                button_done(button);
                $("#UpdateCoach label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdateCoach>div.alert', "Coach Updated Successfully");
                    $("#UpdateCoach>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateCoach>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateCoach>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#UpdateCoach label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [  
                        '#UpdateCoach #Coach_fullname',
                        '#UpdateCoach #Coach_lastname',
                        '#UpdateCoach #Coach_address',
                        '#UpdateCoach #Coach_phone',
                        '#UpdateCoach #Coach_email',
                        '#UpdateCoach #Coach_salary',
                        '#UpdateCoach #Coach_lastname',
                        '#AddCoach #Coach_type'

                    ],
                    [   'full_name',
                        'lastname',
                        'address',
                        'phone',
                        'email',
                        'salary',
                        'lastname',
                        'type_id'

                    ]
                );
            }
        });
    })

});