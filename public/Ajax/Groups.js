$("#AddGroup").submit(function(e){
    var button = $('#AddGroup button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/group/add",
        type:"POST",
        data:$("#AddGroup").serialize(),
        success:function(data){
            //alert(data);
            button_done(button);
            $("#AddGroup label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#AddGroup>div.alert', "Group Added Successfully");
                $("#AddGroup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddGroup>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddGroup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){
            reload(data); //tellme(data)
            button_done(button);
            var error = data.responseJSON;
            $("#AddGroup label.alert").fadeIn().addClass("alert-danger");
            error_handler(
                error,
                [
                    '#AddGroup #group_name'
                ],
                [
                    'name'
                ]
            );
        }
    });
})
