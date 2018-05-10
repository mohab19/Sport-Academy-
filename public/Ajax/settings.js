$(function () {
    $("#UpdateInfo").submit(function(e){
        var button = $('#UpdateInfo>div>button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/settings/update/info",
            type:"POST",
            data : $("#UpdateInfo").serialize(),
            success:function(data){
                button_done(button);
                $("#UpdateInfo label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdateInfo>div.alert', "Data Updated Successfully");
                    $("#UpdateInfo>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    $("#UpdateInfo>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdateInfo label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdateInfo #User_fullname',
                        '#UpdateInfo #User_phone',
                        '#UpdateInfo #User_address',
                        '#UpdateInfo #User_email',
                        '#UpdateInfo #User_username',
                        '#UpdateInfo #User_school',

                    ],
                    [   'full_name',
                        'phone',
                        'address',
                        'email',
                        'username',
                        'school',
                    ]
                );
            }
        });
    })
    $("#UpdatePicture").submit(function(e){
        var button = $('#UpdatePicture>div>button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/settings/update/picture",
            type:"POST",
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success:function(data){
                button_done(button);
                $("#UpdatePicture label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdatePicture>div.alert', "Data Updated Successfully");
                    $("#UpdatePicture>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else if(data == 2)
                {
                    $("#UpdatePicture label.alert").addClass("alert-danger").fadeIn();
                    PrintOnSelector('#UpdatePicture label#User_old_password', "Enter password correctly");

                }
                else {
                    PrintOnSelector('#UpdatePicture>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdatePicture>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdatePicture label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdatePicture #User_picture',

                    ],
                    [
                        'picture',

                    ]
                );
            }
        });
    })
    $("#UpdatePassword").submit(function(e){
        var button = $('#UpdatePassword>div>button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/settings/update/password",
            type:"POST",
            data : $("#UpdatePassword").serialize(),
            success:function(data){
              // alert(data);
                button_done(button);
                $("#UpdatePassword label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdatePassword>div.alert', "Data Updated Successfully");
                    $("#UpdatePassword>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else if(data == 2)
                {
                    $("#UpdatePassword label#User_old_password").addClass("alert-danger").fadeIn();
                    PrintOnSelector('#UpdatePassword label#User_old_password', "Enter password correctly");
                }
                else {
                    PrintOnSelector('#UpdatePassword>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdatePassword>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdatePassword label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdatePassword #User_old_password',
                        '#UpdatePassword #User_password',
                        '#UpdatePassword #User_password_confirm'

                    ],
                    [
                        'old_password',
                        'password',
                        'password_confirmation'

                    ]
                );
            }
        });
    })

});