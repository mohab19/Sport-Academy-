<!doctype html>
<html>

<head>
    <!-- Css Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/select.min.css') }}" media="all">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="all">

    <style>
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default
        {
            color:#5356a5 !important;
            border-color:#5356a5 !important;
        }
        .ui-widget-header,
        .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight
        {
            background:#5356a5 !important;
            border:0 !important;
            color:#fff !important;
        }
        #loading
        {
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            width:30%;
            height:250px;
            background: #fff;
            z-index:99999999;
            position:fixed;
            top:25%;
            left:35%;
            display: none;
        }
    </style>
    <!-- Css Files -->
    <meta charset="utf-8">
    <title>KillingShot - @yield('title')
    </title>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="background"></div>
<div class="background2"></div>
<div id="loading" class="text-center">
    <img style="margin-top:80px"  src="{{ asset('images/loading.gif') }}" alt="">
</div>
@yield('contents')
<marquee>
    @foreach($sponsors as $sponsor)
        <img width="50" height="50" class="img-rounded" style="margin:5px" src="{{$sponsor->picture}}" alt="">
        @endforeach
</marquee>
<!-- start copyright -->
<div class="copyright">
    <div class="container">
            <p class="dark-gray fl-left" style="padding-top:24px;">
                2016|All copyrights reserved
            </p>
            <p class="dark-gray fl-right" style="padding-top:12px;">
                Powered by
                <a href="http://apt-ware.com" target="_blank"><img src="{{ asset('images/aptware.png')}}" width="40"></a>
            </p>
    </div>
</div>
<!-- end copyright-->
@include('layouts.loading')
<!-- Js Files -->
<script src="{{ asset('js/jquery-3.1.0.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/wow.min.js')}}"></script>
{{--<script src="{{ asset('js/jquery.nicescroll.min.js')}}"></script>--}}
<script src="{{ asset('js/jquery-ui.js')}}"></script>
<script src="{{ asset('Ajax/ErrorHandler.js') }}"></script>
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/html2canvas.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>--}}
<!-- DataTables -->
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/select.min.js')}}"></script>
<script src="{{ asset('js/print.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script>
    new WOW().init();
</script>

<script>
    $('.list-view').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false
    });
</script>
<script>
    $("input[type=file]").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn main-button",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
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
<script>
    $('input[type=date]').datepicker({
        // Consistent format with the HTML5 picker
        dateFormat: 'yy-mm-dd'
    });
</script>
<script>
    function PrePrint(selector) {
        HideElement('body *');
        var item = selector.parent().siblings("div.pdf");
        item.show();
        item.find("table").show();
        item.find("table *").show();
        HideElement('.ignorepdf');
        $("body").append(item);
        document.title = "";
    }
    function PostPrint() {
        location.reload();
    }
    $(document).on('click','button.print',function() {
        PrePrint($(this));
            print();
        PostPrint();
        })

</script>
{{--<script>--}}
{{--//    $("button.print").click(function(){--}}
{{--//        alert("2");--}}
{{--//        $(".ignorepdf").css("display","none");--}}
{{--//        var doc = new jsPDF(--}}
{{--//                {--}}
{{--//                    orientation: 'landscape',--}}
{{--//                    format: 'a4'--}}
{{--//                }--}}
{{--//        );--}}
{{--//        var source = $(this).siblings(".pdf")[0];--}}
{{--//        doc.addHTML(source,function () {--}}
{{--//            doc.output("dataurlnewwindow");--}}
{{--//            $(".ignorepdf").css("display","block");--}}
{{--//            $(".ignorepdf").css("display","grid");--}}
{{--//        });--}}
{{--//--}}
{{--//    });--}}
{{--</script>--}}
@yield('script')

</body>
</html>