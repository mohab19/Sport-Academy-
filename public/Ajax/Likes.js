$(function () {

    $('.Like').click(function (e) {
        var LikeIcon = $(this);
        var like = $(this).attr('data-like');
        var token = $("input[name='_token']");
        var post_id = $(this).parent().parent().siblings(".post").attr('data-post-id');
        if(like == 0)
        {
            $.ajax({
                url : '/like/add',
                type: 'Post',
                data : {like : like,post_id: post_id ,_token : token},
                success: function (data) {
                  // alert(data)
                    $("#AddComment label.alert").fadeOut();
                    button_done(button);
                    if(data == 1)
                    {
                        LikeIcon.removeClass("fa-thumps-o-up").addClass("fa-thumps-up");
                        LikeIcon.attr('data-like','1')
                    }
                },
                error:function(data){reload(data); //tellme(data)
                  // alert(data['responseText']);
                }
            });
        }
        else if(like == 1)
        {
            $.ajax({
                url : '/like/delete',
                type: 'Post',
                data : {like : like,post_id: post_id ,_token : token},
                success: function (data) {
                  // alert(data)
                    $("#AddComment label.alert").fadeOut();
                    button_done(button);
                    if(data == 1)
                    {
                        LikeIcon.removeClass("fa-thumps-up").addClass("fa-thumps-o-up");
                        LikeIcon.attr('data-like','1')
                    }
                },
                error:function(data){reload(data); //tellme(data)
                  // alert(data['responseText']);
                }
            });
        }

    });
    $(".AddCommentButton").click(function(){
        var Post = $(this).parent().parent().siblings(".post").attr('data-post-id');
        // alert(Post)
        $("#AddComment input[name='post_id']").val(Post);
    })
    $("#DeleteComment").submit(function(e){
        var button = $('#DeleteComment button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/like/delete",
            type:"Post",
            data:$("#DeleteComment").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteComment label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteComment>div.alert', "Comment Deleted Successfully");
                    $("#DeleteComment>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteComment>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteComment>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                // alert(data['responseText']);
                PrintOnSelector('#DeleteComment>div.alert', "Cannot Delete This Comment");
                $("#DeleteComment>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
});