    $(function () {
        var EmployeeID = $("div#private>input#EmployeeID").val();
        $("#UpdateEmployee").submit(function(e){
            var button = $('#UpdateEmployee>div>button');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url:"/employee/"+EmployeeID+"/update",
                type:"POST",
                data : new FormData(this),
                contentType: false,
                cache      : false,
                processData: false,
                success:function(data){
                   //alert(data);
                    button_done(button);
                    $("#UpdateEmployee label.alert").fadeOut();
                    if(data == 1)
                    {
                        PrintOnSelector('#UpdateEmployee>div.alert', "Employee Updated Successfully");
                        $("#UpdateEmployee>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                    else {
                        PrintOnSelector('#UpdateEmployee>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#UpdateEmployee>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }
                },
                error:function(data){
                    reload(data);
                    //
                    //
                    //
                    button_done(button);
                    //alert(data['responseText']);
                    var error = data.responseJSON;
                    $("#UpdateEmployee label.alert").addClass("alert-danger").fadeIn();
                    error_handler(
                        error,
                        [
                            '#UpdateEmployee #Employee_fullname',
                            '#UpdateEmployee #Employee_address',
                            '#UpdateEmployee #Employee_place',
                            '#UpdateEmployee #Employee_phone',
                            '#UpdateEmployee #Employee_email',
                            '#UpdateEmployee #Employee_username',
                            '#UpdateEmployee #Employee_salary',
                            '#UpdateEmployee #Employee_birthdate'

                        ],
                        [   'full_name',
                            'address',
                            'places_id',
                            'phone',
                            'email',
                            'username',
                            'salary',
                            'birthdate'

                        ]
                    );
                }
            });
        })
    });