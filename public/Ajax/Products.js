$(function () {
    $("select[name='user_id']").change(function(){
        waiting();
        if($(this).val() == "outside")
            $("input[name='name']").parent().fadeIn();
        else
            $("input[name='name']").parent().fadeOut();
        finish();
    });
    $('#AddProduct').submit(function (e) {
        var button = $('#AddProduct button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/product/add',
            type: 'Post',
            data : new FormData(this),
            contentType: false,
            cache      : false,
            processData: false,
            success: function (data) {
                $("#AddProduct label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#AddProduct>div.alert', "Product Added Successfully");
                    $("#AddProduct>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#AddProduct>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#AddProduct>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){reload(data); //tellme(data)
                // alert(data['responseText']);
                //
                //
                //
                var error = data.responseJSON;
                button_done(button);
                $("#AddProduct label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#AddProduct #product_name',
                        '#AddProduct #product_quantity',
                        '#AddProduct #product_price',
                        '#AddProduct #product_paid',
                    ],
                    [
                        'name',
                        'quantity',
                        'price',
                        'paid',
                    ]
                );
            }
        });
    });
    function GetDataToSend() {
        return {
            _token: $('#SellProduct input[name="_token"]').val(),
            id: $('#SellProduct input[name="id"]').val(),
            quantity: $('#SellProduct input[name="quantity"]').val(),
            discount: $('#SellProduct input[name="discount"]').val()
        };
    }

    function SendCalculationInfo() {
        // waiting();
        $.ajax({
            url: '/product/calculate',
            type: 'POST',
            data: GetDataToSend(),
            success: function (data) {
                //alert(data);
                if (data == -1) {
                    PrintOnSelector('#SellProduct>div.alert', "This amount not found in stock");
                    $("#SellProduct>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $('#SellProduct span#Required').html(0);
                }
                else
                {
                    $("#SellProduct div.alert").html("").fadeOut();
                    $('#SellProduct span#Required').html(data+" LE");
                }
                // finish();

            },
            error:function(data){reload(data); //tellme(data)
                // alert(data['responseText']);
            }
        });
    }
    $("#SellProduct input[name='quantity']").keyup(function(){
        SendCalculationInfo();
    })
    $("#SellProduct input[name='discount']").keyup(function(){
        SendCalculationInfo();
    })
    $(".SellProductButton").click(function(){
        var ProductID = $(this).attr('data-id');
        $("#SellProduct input[name='id']").val(ProductID);
        // alert(ProductID)
    })
    $("#SellProduct").submit(function(e){
        var button = $('#SellProduct button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/product/sell",
            type: 'Post',
            data:$("#SellProduct").serialize(),
            success:function(data){
               // alert(data);
                button_done(button);
                $("#SellProduct label.alert").fadeOut();
                if(data != 1)
                {
                    PrintOnSelector('#SellProduct>div.alert', "Product Sold Successfully");
                    $("#SellProduct>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            w = window.open('','newtab'); d = w.document.open("text/html","replace");

                            d.writeln(data);
                            location.reload();
                        });
                    });
            }
               else if(data == 2)
                {
                    PrintOnSelector('#SellProduct>div.alert', "Paid is too large");
                    $("#SellProduct>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn();
            }
                else {
                    PrintOnSelector('#SellProduct>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#SellProduct>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data); //tellme(data)
                //alert(data['responseText']);



                var error = data.responseJSON;
                button_done(button);
                $("#SellProduct label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#SellProduct #product_user',
                        '#SellProduct #product_name',
                        '#SellProduct #product_quantity',
                        '#SellProduct #product_paid',
                    ],
                    [
                        'user_id',
                        'name',
                        'quantity',
                        'paid',
                    ]
                );
            }
        });
    })
});