$(function () {

    function GetDataToSend() {
        return {
            _token: $('#AddPlayer input[name="_token"]').val(),
            level_id: $('#AddPlayer select[name="level_id"]').val(),
            extra_id: $('#AddPlayer select[name="extra_id"]').val(),
            discount: $('#AddPlayer input[name="discount"]').val()
        };
    }

    function SendCalculationInfo() {
        $.ajax({
            url: '/player/calculate',
            type: 'POST',
            data: GetDataToSend(),
            success: function (data) {
                //alert(data);
                if (data) {
                    $('#RequiredMoney').html(data);
                    $('input[name="total"]').val(data);
                }
            },
            error:function(data){reload(data); //tellme(data)
                //alert(data['responseText']);
                //var error = data.responseJSON;
            }
        });
    }
    $("#Calc").click(function(){
        button_waiting($(this));
        SendCalculationInfo();
        button_done($(this));
    })
    $('#AddPlayer').submit(function (e) {
        var button = $('#AddPlayer button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/player/add',
            type: 'POST',
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                // alert(data);
                $("#AddPlayer label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddPlayer>div.alert', "Registration Successfully , You need to make Subscription to Activate Account");
                    $("#AddPlayer>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(3000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddPlayer>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddPlayer>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                reload(data);
                tellme(data)
               // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#AddPlayer label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#AddPlayer #Player_fullname',
                        '#AddPlayer #Player_school',
                        '#AddPlayer #Player_level',
                        '#AddPlayer #Player_place',
                        '#AddPlayer #Player_home',
                        '#AddPlayer #Player_phone',
                        '#AddPlayer #Player_address',
                        '#AddPlayer #Player_birthdate',
                        '#AddPlayer #Player_paid',
                        '#AddPlayer #Player_email',
                        '#AddPlayer #Player_username',
                        '#AddPlayer #Player_password'

                    ],
                    [   'full_name',
                        'school',
                        'level_id',
                        'place_id',
                        'home',
                        'phone',
                        'address',
                        'birthdate',
                        'paid',
                        'email',
                        'username',
                        'password'
                    ]
                );
            }
        });
    });
    $(".DeletePlayer").click(function(){
        var PlayerID = $(this).attr("data-id");
        // alert(PlayerID);
        $("#DeletePlayer input.hidden").val(PlayerID);
    })
    $("#DeletePlayer").submit(function(e){
        var button = $('#DeletePlayer button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/player/delete",
            type:"POST",
            data:$("#DeletePlayer").serialize(),
            success:function(data){
                // alert(data);
                button_done(button);
                $("#DeletePlayer label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeletePlayer>div.alert', "Player Deleted Successfully");
                    $("#DeletePlayer>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeletePlayer>div.alert', "Unexpected Error Come , Please Try Again");
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
                PrintOnSelector('#DeletePlayer>div.alert', "Cannot Delete This Player");
                $("#DeletePlayer>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $(".UpdatePlayer").click(function(){
        var PlayerID = $(this).attr("data-id");
        var PlayerFirstName = $.trim($(this).parent().siblings("td#firstname").text());
        var PlayerLastName = $.trim($(this).parent().siblings("td#lastname").text());
        var PlayerBirthdate = $.trim($(this).parent().siblings("td#birthdate").text());
        var PlayerPhone = $.trim($(this).parent().siblings("td#phone").text());
        var PlayerAddress = $.trim($(this).parent().siblings("td#address").text());
        var PlayerEmail = $.trim($(this).parent().siblings("td#email").text());
        var PlayerSalary = $.trim($(this).parent().siblings("td#salary").text());
        var PlayerType = $.trim($(this).parent().siblings("td#type").text());
        var PlayerFacebook = $.trim($(this).parent().siblings("td#facebook").children('a').attr('href'));
        $("#UpdatePlayer input.hidden").val(PlayerID);
        $("#UpdatePlayer input.Firstname").val(PlayerFirstName);
        $("#UpdatePlayer input.Lastname").val(PlayerLastName);
        $("#UpdatePlayer input.Birthdate").val(PlayerBirthdate);
        $("#UpdatePlayer input.Phone").val(PlayerPhone);
        $("#UpdatePlayer input.Address").val(PlayerAddress);
        $("#UpdatePlayer input.Email").val(PlayerEmail);
        $("#UpdatePlayer input.Salary").val(PlayerSalary);
        $("#UpdatePlayer select").val(PlayerType);
        $("#UpdatePlayer input.Facebook").val(PlayerFacebook);

    })
    $("#UpdatePlayer").submit(function(e){
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
                var error = data.responseJSON;
                button_done(button);
                $("#UpdatePlayer label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdatePlayer #Player_fullname',
                        '#UpdatePlayer #Player_secondname',
                        '#UpdatePlayer #Player_lastname',
                        '#UpdatePlayer #Player_address',
                        '#UpdatePlayer #Player_phone',
                        '#UpdatePlayer #Player_email',
                        '#UpdatePlayer #Player_salary',
                        '#UpdatePlayer #Player_lastname',
                        '#AddPlayer #Player_type'

                    ],
                    [   'full_name',
                        'secondname',
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