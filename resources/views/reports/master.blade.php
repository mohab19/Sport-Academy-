<!doctype html>
<html>

<head>
    <!-- Css Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media='all'>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" media='all'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media='all'>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" media='all'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media='all'>
    <style>
        @media print {
            a[href]:after {
                content: none !important;
            }
        }
    body
    {
        overflow: auto !important;
    }
    .info td
    {
        color:#fff;
    }
    table td a
    {
        color:#5356a5 !important;
    }
    </style>
</head>
<body>
<div class="box box-lg col-md-12">
    <div class="col-md-10"> <!-- search player -->
        <div class="col-xs-12 filter" id="Players-Filter"></div>
    </div>
        <button class="main-button col-md-2 print">Print</button>
    <div class="pdf">
        <table id="Players-table" class="table text-center list-view">
            <thead>
            <tr class="info">
                @yield("table-head")
            </tr>
            </thead>
            <tbody>
            @yield("table-body")
            </tbody>
        </table>
    </div>
</div>

<!-- Js Files -->
<script src="{{ asset('js/jquery-3.1.0.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/jquery-ui.js')}}"></script>
<script src="{{ asset('Ajax/ErrorHandler.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/print.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script>
    function PrePrint(selector) {
        HideElement('body *');
        var item = selector.siblings("div.pdf");
        item.show();
        item.find("#Players-table_wrapper").show();
        item.find("#Players-table_wrapper *").show();
        HideElement('.ignorepdf');
        $("body").append(item);
        document.title = "";
    }
    function PostPrint() {
        window.close();
    }
    $(document).on('click','button.print',function() {
        PrePrint($(this));
        print();
        PostPrint();
    })

</script>
<script>
    $('.list-view').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false
    });
</script>
<script>
    $(".dataTables_filter input").removeClass("form-control input-sm").
    appendTo("#Players-Filter,#Coaches-Filter,#Absences-Filter");
    $(".dataTables_length select").removeClass("form-control input-sm").
    appendTo("#Players-Length,#Coaches-Length,#Managements-Length");
    $("div.dataTables_length label , div.dataTables_filter label").remove();
    $("div.filter input").attr('placeholder','Search ...');

    $(".dataTables_paginate").detach().appendTo(".pagination");
</script>
</body>
</html>