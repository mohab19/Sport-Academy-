$(function () {


    $('#UpdateProductInformation').submit(function (e) {
        var button = $('#UpdateProductInformation button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/product/update/information',
            type: 'Post',
            data:$("#UpdateProductInformation").serialize(),
            success: function (data) {
                $("#UpdateProductInformation label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#UpdateProductInformation>div.alert', "Information Updated Successfully");
                    $("#UpdateProductInformation>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateProductInformation>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateProductInformation>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdateProductInformation label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdateProductInformation #product_name',
                        '#UpdateProductInformation #product_description',
                        '#UpdateProductInformation #product_price',
                    ],
                    [
                        'name',
                        'description',
                        'price',
                    ]
                );
            }
        });
    });
    $('#UpdateProductQuantity').submit(function (e) {
        var button = $('#UpdateProductQuantity button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/product/update/quantity',
            type: 'Post',
            data:$("#UpdateProductQuantity").serialize(),
            success: function (data) {
                $("#UpdateProductQuantity label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#UpdateProductQuantity>div.alert', "Quantity Updated Successfully");
                    $("#UpdateProductQuantity>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateProductQuantity>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateProductQuantity>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                reload(data);
                //tellme(data)
              // alert(data['responseText']);
                var error = data.responseJSON;
                button_done(button);
                $("#UpdateProductQuantity label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdateProductQuantity #product_quantity',
                        '#UpdateProductQuantity #product_paid',
                    ],
                    [
                        'quantity',
                        'paid',
                    ]
                );
            }
        });
    });
    $('#UpdateProductPicture').submit(function (e) {
        var button = $('#UpdateProductPicture button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/product/update/picture',
            type: 'Post',
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                $("#UpdateProductPicture label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#UpdateProductPicture>div.alert', "Picture Updated Successfully");
                    $("#UpdateProductPicture>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#UpdateProductPicture>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#UpdateProductPicture>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
                $("#UpdateProductPicture label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#UpdateProductPicture #product_picture',
                    ],
                    [
                        'picture',
                    ]
                );
            }
        });
    });
    $("#DeleteProduct").submit(function(e){
        var button = $('#DeleteProduct button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/product/delete",
            type: 'Post',
            data:$("#DeleteProduct").serialize(),
            success:function(data){
                button_done(button);
                $("#DeleteProduct label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteProduct>div.alert', "Product Deleted Successfully");
                    $("#DeleteProduct>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteProduct>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteProduct>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                button_done(button);
                //alert(data['responseText']);
                PrintOnSelector('#DeleteProduct>div.alert', "Cannot Delete This Product");
                $("#DeleteProduct>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })
});