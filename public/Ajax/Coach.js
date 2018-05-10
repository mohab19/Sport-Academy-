$(function () {
    $("#UpdateCoach").submit(function(e){
        var button = $('#UpdateCoach>div>button ');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/coach/update",
            type:"POST",
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success:function(data){
              // alert(data);
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
            error:function(data){reload(data);
              //tellme(data);
                // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#UpdateCoach label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [  
                        '#UpdateCoach #Coach_fullname',
                        '#UpdateCoach #Coach_address',
                        '#UpdateCoach #Coach_phone',
                        '#UpdateCoach #Coach_email',
                        '#UpdateCoach #Coach_username',
                        '#UpdateCoach #Coach_salary',
                        '#UpdateCoach #Coach_lastname',
                        '#UpdateCoach #Coach_places_id',
                        '#AddCoach #Coach_type'

                    ],
                    [   'full_name',
                        'address',
                        'phone',
                        'email',
                        'username',
                        'salary',
                        'lastname',
                        'places_id',
                        'type_id'

                    ]
                );
            }
        });
    })

});