$(function () {
    $('#AddEmployee').submit(function (e) {
        var button = $('#AddEmployee button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/employee/add',
            type: 'POST',
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                // alert(data);
                $("#AddEmployee label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddEmployee>div.alert', "Employee Added Successfully");
                    $("#AddEmployee>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddEmployee>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddEmployee>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                reload(data);
                // tellme(data)
                //
                //
                //
                var error = data.responseJSON;
                button_done(button);
                $("#AddEmployee label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddEmployee #Employee_fullname',
                        '#AddEmployee #Employee_place',
                        '#AddEmployee #Employee_email',
                        '#AddEmployee #Employee_phone',
                        '#AddEmployee #Employee_address',
                        '#AddEmployee #Employee_birthdate',
                        '#AddEmployee #Employee_role_id',
                        '#AddEmployee #Employee_salary'

                    ],
                    [   'full_name',
                        'places_id',
                        'email',
                        'phone',
                        'address',
                        'birthdate',
                        'role_id',
                        'salary'
                    ]
                );
            }
        });
    });
    $(".DeleteEmployeeButton").click(function(){
        var EmployeeID = $(this).attr("data-id");
        // alert(EmployeeID);
        $("#DeleteEmployee input[name='id']").val(EmployeeID);
    })
    $("#DeleteEmployee").submit(function(e){
        var button = $('#DeleteEmployee button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/employee/delete",
            type:"POST",
            data:$("#DeleteEmployee").serialize(),
            success:function(data){
                // alert(data);
                button_done(button);
                $("#DeleteEmployee label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteEmployee>div.alert', "Employee Deleted Successfully");
                    $("#DeleteEmployee>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteEmployee>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteEmployee>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
               // alert(data['responseText']);
                PrintOnSelector('#DeleteEmployee>div.alert', "Cannot Delete This Employee");
                $("#DeleteEmployee>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })

});