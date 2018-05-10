var InComeID;
$(".PayProductDebt").click(function(){
InComeID = $(this).attr('data-id');
});
$("#PayProductDebt").submit(function(e){
    var button = $('#PayProductDebt button');
    button_waiting(button);
    e.preventDefault();
    $.ajax({
        url:"/product/debt/"+InComeID+"/pay",
        type:"POST",
        data:$("#PayProductDebt").serialize(),
        success:function(data){
          // alert(data);
            button_done(button);
            $("#PayProductDebt label.alert").fadeOut();
            if(data != 1)
            {
                PrintOnSelector('#PayProductDebt>div.alert', "Debt Paid Successfully");
                $("#PayProductDebt>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        w = window.open('','newtab'); d = w.document.open("text/html","replace");

                        d.writeln(data);
                        location.reload();
                    });
                });
            }
            else if(data == 2)
            {
                PrintOnSelector('#PayProductDebt>div.alert', "Enter the value correctly");
                $("#PayProductDebt>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                });
            }

            else {
                PrintOnSelector('#PayProductDebt>div.alert', "Unexpected Error Come , Please Try Again");
                $("#PayProductDebt>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }


        },
        error:function(data){reload(data); //tellme(data)
            button_done(button);



            var error = data.responseJSON;
            $("#PayProductDebt label.alert").addClass("alert-danger").fadeIn();
            error_handler(
                error,
                [
                    '#PayProductDebt #User_paid'
                ],
                [
                    'paid'

                ]
            );
        }
    });
})