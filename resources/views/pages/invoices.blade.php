@extends('layouts.dashboard')

@section('style')

    <style>
    </style>
@endsection

@section('title')
    Invoices
@endsection

@section('tab')

    @include('forms.invoices.search')

@endsection
@section('script')
    <script>
        $("#SearchInvoice").submit(function(e){
            waiting();
            var button = $('#SearchInvoice button[type="submit"]');
            button_waiting(button);
            e.preventDefault();
            $.ajax({
                url:"/invoice/search",
                type: 'Post',
                data:$("#SearchInvoice").serialize(),
                success:function(data){
                    alert(data);
                    finish();
                    button_done(button);
                    $("#SearchInvoice label.alert").fadeOut();
                   if(data == 2) {
                        PrintOnSelector('#SearchInvoice>div.alert', "Invoice Not Found");
                        $("#SearchInvoice>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn()
                    }
                   else
                   {
                       w = window.open('','newtab');
                       d = w.document.open("text/html","replace");
                       d.writeln(data);
                       location.reload();
                   }
                },
                error:function(data){
//                    reload(data);
                    w = window.open('','newwinow','width=800,height=600,menubar=1,status=0,scrollbars=1,resizable=1');
                    d = w.document.open("text/html","replace");
                    d.writeln(data['responseText']);    
//                    tellme(data)
                    button_done(button);
                    var error = data.responseJSON;
                    $("#SearchInvoice label.alert").addClass("alert-danger").fadeIn();
                    error_handler(
                            error,
                            [
                                '#SearchInvoice #invoice_invoice_id',
                            ],
                            [
                                'invoice_id',
                            ]
                    );
                }
            });
        })
    </script>
@endsection