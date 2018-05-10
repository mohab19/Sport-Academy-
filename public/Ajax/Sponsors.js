$('#AddSponsor').submit(function (e) {
    var button = $('#AddSponsor button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url : '/sponsor/add',
        type: 'Post',
        data : new FormData(this),
        contentType: false,
        cache      : false,
        processData: false,
        success: function (data) {
            $("#AddSponsor label.alert").fadeOut();
            button_done(button);
            if(data == 1)
            {
                PrintOnSelector('#AddSponsor>div.alert', "Sponsor Added Successfully");
                $("#AddSponsor>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddSponsor>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddSponsor>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
            $("#AddSponsor label.alert").addClass("alert-danger").fadeIn();
            error_handler(
                error,
                [
                    '#AddSponsor #sponsor_logo'
                ],
                [
                    'logo'
                ]
            );
        }
    });
});
var SponsorID;
$(".DeleteSponsorButton").click(function(){
    SponsorID = $(this).attr("data-id");
})
$("#DeleteSponsor").submit(function(e){
    var button = $('#DeleteSponsor button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/sponsor/"+SponsorID+"/delete",
        type:"POST",
        data:$("#DeleteSponsor").serialize(),
        success:function(data){
            // alert(data);
            button_done(button);
            $("#DeleteSponsor label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#DeleteSponsor>div.alert', "Sponsor Deleted Successfully");
                $("#DeleteSponsor>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#DeleteSponsor>div.alert', "Unexpected Error Come , Please Try Again");
                $("#DeleteSponsor>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            // alert(data['responseText']);
            PrintOnSelector('#DeleteSponsor>div.alert', "Cannot Delete This Sponsor");
            $("#DeleteSponsor>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                $(this).delay(1000).fadeOut(function () {
                    location.reload();
                });
            });
        }
    });
})