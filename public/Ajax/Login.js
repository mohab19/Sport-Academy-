
$(function () {

    $('#login').submit(function (e) {
        var button = $("#login button");
        button_waiting(button);
        e.preventDefault();
        var jsoner = {
            _token: $('#login input[name="_token"]').val(),
            username : $('#login input[name="username"]').val(),
            password : $('#login input[name="password"]').val(),
            remember : $('#login input[name="remember"]').val()
        };
        $.ajax({
            url: '/user/login',
            type: 'POST',
            dataType: 'Json',
            data: jsoner,
            success:function (data) {
                button_done(button);
                $("#login label.alert").fadeOut();
                var auth = data.auth;
                var to_go = data.intended;
                if(auth == true) {
                    PrintOnSelector('#login>div.alert', "Welcome Back");
                    $("#login>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.href = to_go;
                        });
                    });
                }
                else {
                    PrintOnSelector('#login>div.alert', "Wrong Username Or Password");
                    $("#login>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    });
                }
            },
            error:function (data) {
                button_done(button);
                $("#login label.alert").addClass("alert-danger").fadeIn();
               // alert(data['responseText']);
                var error = data.responseJSON;
                error_handler(
                    error,
                    ['#username_error','#password_error'],
                    ["username","password"]
                );
            }
        });
    })
});