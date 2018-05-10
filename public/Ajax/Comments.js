$(function () {
    $(document).on("focus","form.AddComment input",function (e) {
        startFlag = 0;
    });
    $(document).on("blur","form.AddComment input",function (e) {
        startFlag = 1;
    });
    // // extension:
    // $.fn.scrollEnd = function(callback, timeout) {
    //     $(this).scroll(function(){
    //         var $this = $(this);
    //         if ($this.data('scrollTimeout')) {
    //             clearTimeout($this.data('scrollTimeout'));
    //         }
    //         $this.data('scrollTimeout', setTimeout(callback,timeout));
    //     });
    // };
    //
    // // how to call it (with a 1000ms timeout):
    // $(".previous-comments").scrollEnd(function(){
    //     alert('stopped scrolling');
    // }, 400);
    // $(".previous-comments").live("scroll",function (e) {
    //     alert(1)
    // });
    $(document).on("submit","form.AddComment",function (e) {
        var this_var = $(this);
        e.preventDefault();
        $.ajax({
            url : '/comment/add',
            type: 'Post',
            data: this_var.serialize(),
            dataType: "html",   //expect html to be returned
            success: function (data) {
                if(data)
                {
                    startFlag = 1;
                    this_var.find("input[name='body']").val("");
                    this_var.find("input[name='body']").blur();
                }
                // this_var.parent().siblings(".previous-comments").append(data);

                // var comments_count = this_var.parent().siblings(".previous-comments").find(".info span");
                // comments_count.text(parseInt(comments_count.text())+1);
            },
            error:function(data){reload(data);
                // tellme(data)
                 // alert(data['responseText']);
                var error = data.responseJSON;
                $("#AddComment label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddComment #Comment_body',
                    ],
                    [   'body',
                    ]
                );
            }
        });
    });
    var CommentToDelete;
    $(document).on('click','.DeleteCommentButton',function(){
        startFlag = 0;
        var CommentID = $(this).attr('data-id');
        CommentToDelete = $(this).parent().parent().parent().parent().parent();
        $("#DeleteComment input[name='id']").val(CommentID);
        // alert(CommentID)
    })
    $("#DeleteComment").submit(function(e){
        var button = $('#DeleteComment button[type="submit"');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/comment/delete",
            type:"Post",
            data:$("#DeleteComment").serialize(),
            success:function(data){
                $("#DeleteComment label.alert").fadeOut();
                if(data == 1)
                {
                    // var comments_count = CommentToDelete.parent().find(".info span");
                    // comments_count.text(parseInt(comments_count.text())-1);
                    // CommentToDelete.remove();
                    startFlag = 1;
                    button_done(button);
                    closePopup();
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
            error:function(data){reload(data);
            tellme(data)
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
    var CommentToUpdate;
    $(document).on('click','.UpdateCommentButton',function(){
        startFlag = 0;
        var CommentID = $(this).attr('data-id');
         CommentToUpdate = $(this).parent().parent().parent().parent().siblings(".comment-body");
        $("#UpdateComment input[name='id']").val(CommentID);
        $("#UpdateComment textarea[name='body']").val($.trim(CommentToUpdate.text()));
    })
    $("#UpdateComment").submit(function(e){
        var button = $('#UpdateComment button[type="submit"');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/comment/update",
            type:"Post",
            data:$("#UpdateComment").serialize(),
            success:function(data){
                $("#UpdateComment label.alert").fadeOut();
                if(data == 1)
                {
                    // var NewComment = $("#UpdateComment textarea").val();
                    // CommentToUpdate.text(NewComment);
                    startFlag = 1;
                    button_done(button);
                    closePopup();
                }
                else {
                    PrintOnSelector('#UpdateComment>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateComment>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); tellme(data)
                 // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#UpdateComment label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#UpdateComment #Comment_body',
                    ],
                    [   'body',
                    ]
                );
            }
        });
    })
});