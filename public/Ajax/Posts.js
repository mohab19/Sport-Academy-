$(function () {
    getFeed();
    function getFeed()
    {
        if(startFlag)
        {
            $('#privatePosts').load('/posts/getfeed/private');
            $('#publicPosts').load('/posts/getfeed/public');
        }

    }
    setInterval(function(){
        getFeed()
    },time)
    $(document).on('click','.AddPostButton',function() {
        startFlag = 0;
    });
    $(document).on('click',function() {
        startFlag = 1;
    });
    $('#AddPost').submit(function (e) {
        var button = $('#AddPost button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/post/add',
            type: 'POST',
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                $("#AddPost label.alert").fadeOut();
                button_done(button);
                if(data == 0)
                {
                    PrintOnSelector('#AddPost>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddPost>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });

                }
                else {
                    // $(".posts").prepend(data);
                    startFlag = 1;
                    closePopup();
                }
            },
            error:function(data){reload(data);
            tellme(data)
                var error = data.responseJSON;
                button_done(button);
                $("#AddPost label.alert").removeClass("alert-success").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#AddPost #Post_body',
                        '#AddPost #Post_group_id',
                        '#AddPost #Post_post_type_id',
                    ],
                    [
                        'body',
                        'group_id',
                        'post_type_id',
                    ]
                );
            }
        });
    });
    var PostToDelete;
    $(document).on('click','.DeletePostButton',function() {
        startFlag = 0;
        var PostID = $(this).attr("data-id");
            PostToDelete = $(this).parent().parent().parent().parent().parent();
            $("#DeletePost input[name='id']").val(PostID);
            //alert(PostID)
        });
        $("#DeletePost").submit(function (e) {
            var button = $('#DeletePost button[type="submit"]');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url: "/post/delete",
                type: "POST",
                data: $("#DeletePost").serialize(),
                success: function (data) {
                    button_done(button);
                    $("#DeletePost label.alert").fadeOut();
                    if (data == 1) {
                        // PostToDelete.remove();
                        startFlag = 1;
                        closePopup();
                    }
                    else {
                        PrintOnSelector('#DeletePost>div.alert', "Unexpected Error Come , Please Try Again");
                        $("#DeletePost>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                            $(this).delay(1000).fadeOut(function () {
                                location.reload();
                            });
                        });
                    }


                },
                error: function (data) {
                    reload(data); tellme(data)
                    button_done(button);
                    //alert(data['responseText']);
                    PrintOnSelector('#DeletePost>div.alert', "Cannot Delete This Post");
                    $("#DeletePost>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            });
        })
        var PostToUpdate;
        $(document).on('click', '.UpdatePostButton', function () {
            startFlag = 0;
            var PostID = $(this).attr("data-id");
                // alert(PostID);
                PostToUpdate = $(this).parent().parent().parent().parent().siblings(".post-body");
                $("#UpdatePost input[name='id']").val(PostID);
                $("#UpdatePost textarea[name='body']").val($.trim(PostToUpdate.text()));
            })
            $("#UpdatePost").submit(function (e) {
                var button = $('#UpdatePost button[type="submit"]');
                button_waiting(button);
                e.preventDefault();
                $.ajax({
                    url: "/post/update",
                    type: "POST",
                    data: $("#UpdatePost").serialize(),
                    success: function (data) {
                        button_done(button);
                        $("#UpdatePost label.alert").fadeOut();
                        if (data == 1) {
                            var NewPost = $("#UpdatePost textarea").val();
                            // PostToUpdate.text(NewPost);
                            startFlag = 1;
                            closePopup();
                        }
                        else {
                            PrintOnSelector('#UpdatePost>div.alert', "Unexpected Error Come , Please Try Again");
                            $("#UpdatePost>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                                $(this).delay(1000).fadeOut(function () {
                                    location.reload();
                                });
                            });
                        }


                    },
                    error: function (data) {
                        reload(data);
                        tellme(data)
                        // alert(data['responseText']);
                        var error = data.responseJSON;
                        button_done(button);
                        $("#UpdatePost label.alert").addClass("alert-danger").fadeIn();
                        error_handler(
                            error,
                            ['#UpdatePost #Post_body',
                            ],
                            ['body',
                            ]
                        );
                    }
                });
            })
        });