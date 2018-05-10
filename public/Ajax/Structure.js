$(function () {

    $('#AddPlayground').submit(function (e) {
        var button = $('#AddPlayground button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/playground/add',
            type: 'POST',
            data: $('#AddPlayground').serialize(),
            success: function (data) {
                $("#AddPlayground label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddPlayground>div.alert', "Playground Added Successfully");
                    $("#AddPlayground>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddPlayground>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddPlayground>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data);
              //tellme(data)
                 // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#AddPlayground label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#AddPlayground #Playground_title',
                        '#AddPlayground #Playground_place'
                    ],
                    [
                        'title',
                        'place_id'
                    ]
                );
            }
        });
    });
    $(".DeletePlayground").click(function(){
        var PlaygroundID = $(this).attr("data-id");
        $("#DeletePlayground input.hidden").val(PlaygroundID);
    })
    $("#DeletePlayground").submit(function(e){
        var button = $('#DeletePlayground button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/playground/delete",
            type:"POST",
            data:$("#DeletePlayground").serialize(),
            success:function(data){
                button_done(button);
                $("#DeletePlayground label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeletePlayground>div.alert', "Playground Deleted Successfully");
                    $("#DeletePlayground>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeletePlayground>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeletePlayground>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                // alert(data['responseText']);
                PrintOnSelector('#DeletePlayground>div.alert', "Cannot Delete This Level");
                $("#DeletePlayground>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $(".UpdatePlayground").click(function(){
        var PlaygroundID = $(this).attr("data-id");
        var PlaygroundTitle = $.trim($(this).parent().siblings("td#title").text());
        var PlaygroundNotes = $.trim($(this).parent().siblings("td#notes").text());
        $("#UpdatePlayground input.hidden").val(PlaygroundID);
        $("#UpdatePlayground input.Title").val(PlaygroundTitle);
        $("#UpdatePlayground input.Notes").val(PlaygroundNotes);
    })
    $("#UpdatePlayground").submit(function(e){
        var button = $('#UpdatePlayground button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/playground/update",
            type:"POST",
            data:$("#UpdatePlayground").serialize(),
            success:function(data){
                button_done(button);
                $("#UpdatePlayground label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdatePlayground>div.alert', "Playground Updated Successfully");
                    $("#UpdatePlayground>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdatePlayground>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdatePlayground>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){
                reload(data);
                //tellme(data);
               //  alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#UpdatePlayground label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#UpdatePlayground #Playground_title',
                    ],
                    [   'title',
                    ]
                );
            }
        });
    })
    $('#AddLevel').submit(function (e) {
        var button = $('#AddLevel button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/level/add',
            type: 'POST',
            data: $('#AddLevel').serialize(),
            success: function (data) {
                $("#AddLevel label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddLevel>div.alert', "Level Added Successfully");
                    $("#AddLevel>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddLevel>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddLevel>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#AddLevel label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddLevel #Level_name',
                        '#AddLevel #Level_price',
                        '#AddLevel #Level_max'
                    ],
                    [   'name',
                        'price',
                        'max'
                    ]
                );
            }
        });
    });
    $(".DeleteLevel").click(function(){
        var LevelID = $(this).attr("data-id");
        $("#DeleteLevel input.hidden").val(LevelID);
    })
    $("#DeleteLevel").submit(function(e){
        var button = $('#DeleteLevel button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/level/delete",
            type:"POST",
            data:$("#DeleteLevel").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteLevel label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteLevel>div.alert', "Level Deleted Successfully");
                    $("#DeleteLevel>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteLevel>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteLevel>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                // alert(data['responseText']);
                PrintOnSelector('#DeleteLevel>div.alert', "Cannot Delete This Level");
                $("#DeleteLevel>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $(".UpdateLevel").click(function(){
        var LevelID = $(this).attr("data-id");
        var LeveLName = $.trim($(this).parent().siblings("td#name").text());
        var LeveLPrice = $.trim($(this).parent().siblings("td#price").text());
        var LeveLNotes = $.trim($(this).parent().siblings("td#notes").text());
        var LeveLMax = $.trim($(this).parent().siblings("td#max").text());
        $("#UpdateLevel input.hidden").val(LevelID);
        $("#UpdateLevel input.Name").val(LeveLName);
        $("#UpdateLevel input.Notes").val(LeveLNotes);
        $("#UpdateLevel input.Price").val(LeveLPrice);
        $("#UpdateLevel input.Max").val(LeveLMax);
    })
    $("#UpdateLevel").submit(function(e){
        var button = $('#UpdateLevel button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/level/update",
            type:"POST",
            data:$("#UpdateLevel").serialize(),
            success:function(data){
                button_done(button);
                $("#UpdateLevel label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdateLevel>div.alert', "Level Updated Successfully");
                    $("#UpdateLevel>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateLevel>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateLevel>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdateLevel label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#UpdateLevel #Level_name',
                        '#UpdateLevel #Level_price'
                    ],
                    [   'name',
                        'price'
                    ]
                );
            }
        });
    })

    $('#AddPlace').submit(function (e) {
        var button = $('#AddPlace button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/place/add',
            type: 'POST',
            data: $('#AddPlace').serialize(),
            success: function (data) {
                $("#AddPlace label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddPlace>div.alert', "Place Added Successfully");
                    $("#AddPlace>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddPlace>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddPlace>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#AddPlace label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddPlace #Place_name',
                        '#AddPlace #Place_price',
                        '#AddPlace #Place_address'
                    ],
                    [   'name',
                        'price',
                        'address'
                    ]
                );
            }
        });
    });
    $(".DeletePlace").click(function(){
        var PlaceID = $(this).attr("data-id");
        $("#DeletePlace input.hidden").val(PlaceID);
    })
    $("#DeletePlace").submit(function(e){
        var button = $('#DeletePlace button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/place/delete",
            type:"POST",
            data:$("#DeletePlace").serialize(),
            success:function(data){
                button_done(button);
                $("#DeletePlace label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeletePlace>div.alert', "Place Deleted Successfully");
                    $("#DeletePlace>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeletePlace>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeletePlace>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                PrintOnSelector('#DeletePlace>div.alert', "Cannot Delete This Place");
                $("#DeletePlace>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $(".UpdatePlace").click(function(){
        var PlaceID = $(this).attr("data-id");
        var PlaceName = $.trim($(this).parent().siblings("td#name").text());
        var PlacePrice = $.trim($(this).parent().siblings("td#price").text());
        var PlaceAddress = $.trim($(this).parent().siblings("td#address").text());
        var PlaceMap = $.trim($(this).parent().siblings("td#map").text());
        $("#UpdatePlace input.hidden").val(PlaceID);
        $("#UpdatePlace input.Name").val(PlaceName);
        $("#UpdatePlace input.Price").val(PlacePrice);
        $("#UpdatePlace input.Address").val(PlaceAddress);
        $("#UpdatePlace input.Map").val(PlaceMap);
    })
    $("#UpdatePlace").submit(function(e){
        var button = $('#UpdatePlace button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/place/update",
            type:"POST",
            data:$("#UpdatePlace").serialize(),
            success:function(data){
                button_done(button);
                $("#UpdatePlace label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdatePlace>div.alert', "Place Updated Successfully");
                    $("#UpdatePlace>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdatePlace>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdatePlace>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdatePlace label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#UpdatePlace #Place_name',
                        '#UpdatePlace #Place_address'
                    ],
                    [   'name',
                        'address'
                    ]
                );
            }
        });
    })


    $('#AddExtra').submit(function (e) {
        var button = $('#AddExtra button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/extra/add',
            type: 'POST',
            data: $('#AddExtra').serialize(),
            success: function (data) {
                $("#AddExtra label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddExtra>div.alert', "Extra Added Successfully");
                    $("#AddExtra>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddExtra>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#AddExtra label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#AddExtra #Extra_name',
                        '#AddExtra #Extra_price'
                    ],
                    [   'name',
                        'price'
                    ]
                );
            }
        });
    });
    $(".DeleteExtra").click(function(){
        var ExtraID = $(this).attr("data-id");
        $("#DeleteExtra input.hidden").val(ExtraID);
    })
    $("#DeleteExtra").submit(function(e){
        var button = $('#DeleteExtra button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/extra/delete",
            type:"POST",
            data:$("#DeleteExtra").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteExtra label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteExtra>div.alert', "Extra Deleted Successfully");
                    $("#DeleteExtra>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteExtra>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                // alert(data['responseText']);
                PrintOnSelector('#DeleteExtra>div.alert', "Cannot Delete This Extra");
                $("#DeleteExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
    $(".UpdateExtra").click(function(){
        var ExtraID = $(this).attr("data-id");
        var ExtraName = $.trim($(this).parent().siblings("td#name").text());
        var ExtraPrice = $.trim($(this).parent().siblings("td#price").text());
        $("#UpdateExtra input.hidden").val(ExtraID);
        $("#UpdateExtra input.Name").val(ExtraName);
        $("#UpdateExtra input.Price").val(ExtraPrice);
    })
    $("#UpdateExtra").submit(function(e){
        var button = $('#UpdateExtra button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/extra/update",
            type:"POST",
            data:$("#UpdateExtra").serialize(),
            success:function(data){
                button_done(button);
                $("#UpdateExtra label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#UpdateExtra>div.alert', "Extra Updated Successfully");
                    $("#UpdateExtra>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateExtra>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateExtra>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdateExtra label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#UpdateExtra #Extra_name',
                        '#UpdateExtra #Extra_price'
                    ],
                    [   'name',
                        'price'
                    ]
                );
            }
        });
    })



});