$('#AddNews').submit(function (e) {
    var button = $('#AddNews button[type="submit"]');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url : '/news/add',
        type: 'Post',
        data : new FormData(this),
        contentType: false,
        cache      : false,
        processData: false,
        success: function (data) {
          // alert(data);
            $("#AddNews label.alert").fadeOut();
            button_done(button);
            if(data == 1)
            {
                PrintOnSelector('#AddNews>div.alert', "News Added Successfully");
                $("#AddNews>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#AddNews>div.alert', "Unexpected Error Come , Please Try Again");
                $("#AddNews>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
            $("#AddNews label.alert").addClass("alert-danger").fadeIn();
            error_handler(
                error,
                [
                    '#AddNews #news_logo'
                ],
                [
                    'logo'
                ]
            );
        }
    });
});
var NewsID;
$(".DeleteNewsButton").click(function(){
    NewsID = $(this).attr("data-id");
})
$("#DeleteNews").submit(function(e){
    var button = $('#DeleteNews button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/news/"+NewsID+"/delete",
        type:"POST",
        data:$("#DeleteNews").serialize(),
        success:function(data){
            // alert(data);
            button_done(button);
            $("#DeleteNews label.alert").fadeOut();
            if(data == 1)
            {
                PrintOnSelector('#DeleteNews>div.alert', "News Deleted Successfully");
                $("#DeleteNews>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
            else {
                PrintOnSelector('#DeleteNews>div.alert', "Unexpected Error Come , Please Try Again");
                $("#DeleteNews>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);
            // alert(data['responseText']);
            PrintOnSelector('#DeleteNews>div.alert', "Cannot Delete This News");
            $("#DeleteNews>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                $(this).delay(1000).fadeOut(function () {
                    location.reload();
                });
            });
        }
    });
})