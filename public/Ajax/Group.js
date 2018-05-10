$(function () {
    $("select[name='type']").change(function(){
        waiting();
        var value = $(this).val();
        $(".type").fadeOut(function(){
            $("div#"+value).delay(500).fadeIn(function(){
                setTimeout(function() {   //calls click event after a certain time
                    finish();
                }, 2000);
            });
        });
    })
    $('#UpdateGroup').submit(function (e) {
        var button = $('#UpdateGroup button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/group/update',
            type: 'Post',
            data:$("#UpdateGroup").serialize(),
            success: function (data) {
                $("#UpdateGroup label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#UpdateGroup>div.alert', " Group Updated Successfully");
                    $("#UpdateGroup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateGroup>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateGroup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                reload(data);
                //tellme(data)
                var error = data.responseJSON;
                button_done(button);
                $("#UpdateGroup label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdateGroup #group_name'
                    ],
                    [
                        'name'
                    ]
                );
            }
        });
    });

    $("#AddUserGroup").submit(function(e){
        var button = $('#AddUserGroup button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/group/user/add",
            type: 'Post',
            data:$("#AddUserGroup").serialize(),
            success:function(data){
                // alert(data);
                button_done(button);
                $("#AddUserGroup label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#AddUserGroup>div.alert', "Added Successfully");
                    $("#AddUserGroup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddUserGroup>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteUserGroup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data);
                tellme(data)
                button_done(button);
            }
        });
    });
    var id;
    $(".DeleteUserGroupButton").click(function(){
         id = $(this).attr("data-id");
    })
    $("#DeleteUserGroup").submit(function(e){
        var button = $('#DeleteUserGroup button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/group/user/"+id+"/delete",
            type: 'Post',
            data:$("#DeleteUserGroup").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteUserGroup label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteUserGroup>div.alert', "Added Successfully");
                    $("#DeleteUserGroup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteUserGroup>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteUserGroup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
            }
        });
    });
    $("#DeleteGroup").submit(function(e){
        var button = $('#DeleteGroup button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/group/delete",
            type: 'Post',
            data:$("#DeleteGroup").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteGroup label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteGroup>div.alert', "Group Deleted Successfully");
                    $("#DeleteGroup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.href="/groups";
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteGroup>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteGroup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                //alert(data['responseText']);
                PrintOnSelector('#DeleteGroup>div.alert', "Cannot Delete This Group");
                $("#DeleteGroup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
});