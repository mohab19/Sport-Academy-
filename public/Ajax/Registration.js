$(function () {
    $('#Signup').submit(function (e) {
        var button = $('#Signup button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/signup',
            type: 'POST',
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                // alert(data);
                $("#Signup label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#Signup>div.alert', "Signup Successfully , You need to make Subscription to Activate Account");
                    $("#Signup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(4000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#Signup>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#Signup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                // reload(data);
                tellme(data)
               // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#Signup label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#Signup #Player_fullname',
                        '#Signup #Player_school',
                        '#Signup #Player_home',
                        '#Signup #Player_phone',
                        '#Signup #Player_address',
                        '#Signup #Player_birthdate',
                        '#Signup #Player_email',
                        '#Signup #Player_username',
                        '#Signup #Player_password'

                    ],
                    [   'full_name',
                        'school',
                        'home',
                        'phone',
                        'address',
                        'birthdate',
                        'email',
                        'username',
                        'password'
                    ]
                );
            }
        });
    });

});