    $(function () {
        $("#UpdatePlayer").submit(function(e){
            var button = $('#UpdatePlayer>div>button');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url:"/player/update",
                type:"POST",
                data : new FormData(this),
                contentType: false,
                cache      : false,
                processData: false,
                success:function(data){
                     // alert(data);
                    button_done(button);
                    $("#UpdatePlayer label.alert").fadeOut();
                    if(data == 1)
                    {
                        PrintOnSelector('#UpdatePlayer>div.alert', "Player Updated Successfully");
                        $("#UpdatePlayer>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                    else {
                        PrintOnSelector('#UpdatePlayer>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#UpdatePlayer>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }


                },
                error:function(data){reload(data);
                // tellme(data);
                    button_done(button);
                    // alert(data['responseText']);
                    var error = data.responseJSON;
                    $("#UpdatePlayer label.alert").addClass("alert-danger").fadeIn();
                    error_handler(
                        error,
                        [
                            '#UpdatePlayer #Player_fullname',
                            '#UpdatePlayer #Player_address',
                            '#UpdatePlayer #Player_school',
                            '#UpdatePlayer #Player_phone',
                            '#UpdatePlayer #Player_email',
                            '#UpdatePlayer #Player_username',
                            '#UpdatePlayer #Player_birthdate',

                        ],
                        [   'full_name',
                            'address',
                            'school',
                            'phone',
                            'email',
                            'username',
                            'birthdate',

                        ]
                    );
                }
            });
        })
        $("#UpdatePlayeraa").submit(function(e){
            var button = $('#UpdatePlayer button');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url:"/player/update",
                type:"POST",
                data:$("#UpdatePlayer").serialize(),
                success:function(data){
                    button_done(button);
                    $("#UpdatePlayer label.alert").fadeOut();
                    if(data == 1)
                    {
                        PrintOnSelector('#UpdatePlayer>div.alert', "Player Updated Successfully");
                        $("#UpdatePlayer>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                    else {
                        PrintOnSelector('#UpdatePlayer>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#UpdatePlayer>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                },
                error:function(data){reload(data); //tellme(data)
                    // alert(data['responseText']);


                }
            });
        })


    });