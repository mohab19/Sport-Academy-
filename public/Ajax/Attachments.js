var UserID = $("#private #UserID").val();
$("#AddAttachment").submit(function(e){
    var button = $('#AddAttachment button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/user/"+UserID+"/attachment/add",
        type: 'POST',
        data : new FormData(this),
        contentType: false,
        cache      : false,
        processData: false,
        success:function(data){
            //alert(data);
            button_done(button);
            $("#AddAttachment label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#AddAttachment>div.alert', "Attachment Added Successfully");
                $("#AddAttachment>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddAttachment>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddAttachment>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
            $("#AddAttachment label.alert").fadeIn().addClass("alert-danger");
            error_handler(
                error,
                [
                    '#AddAttachment #attachment_title',
                    '#AddAttachment #attachment_value'
                ],
                [
                    'title',
                    'value'
                ]
            );
        }
    });
})