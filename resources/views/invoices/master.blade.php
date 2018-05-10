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
        .watermark
        {
            position: absolute;
            top: 30%;
            left: 25%;
            opacity: 0.02;
            transform: rotate(-30deg);
        }
        .watermark img
        {
            width:350px;
            height:320px;
        }
        .col-md-4
        {
            width:33.3333% !important;
        }
        .col-md-9
        {
            width:75% !important;
        }
        .col-md-12
        {
            float: left;
            width:100% !important;
        }
        .col-md-1 {
            width: 8.33333333%;
        }
        .col-md-6 {
            width: 50%;
        }
        .col-md-5 {
            width: 41.66666667%;
        }
        .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
            float: left;
        }
        .text-center
        {
            text-align: center;
        }
        .text-left
        {
            text-align: left;
        }
        .text-right
        {
            text-align: right;
        }
        body
        {
            overflow: auto;
            background: #222;
        }
        #invoice
        {
            width:790px;
            height: 1120px;
            margin: 0 auto;
            background-color: #ecebed !important;
            position: relative;
        }
        h2,h3
        {
            margin:0;
            padding:0;
            letter-spacing:2px;
        }
        h5
        {
            margin:25px;
            font-size:18px;
        }
        h5 i
        {
            margin-right:20px;
        }
        h6
        {
            font-size:20px;
        }
        p{
            letter-spacing:0;
        }
        div.invoice-body
        {
            margin: 70px 0px;
            font-size:25px;
        }
        div.invoice-header
        {
            background: #5356A5 !important;
            padding:40px;
        }
        div.invoice-info
        {
            font-size:16px;
            padding: 50px;
        }
        div.invoice-info p
        {
            color:#5356A5 !important;
        }
        div.invoice-info span
        {
            color:#444 !important;
            padding-left: 5px;
            font-weight: 500;
        }
        div.invoice-body
        {
            padding:50px;
            color:#5356A5 !important;
        }
        div.invoice-body table
        {
                width:100%;
            margin: 20px auto ;
            border:0;
            box-shadow: none;
        }
        div.invoice-body table td
        {
            border:0;
            color:#444 !important;
            padding:20px;
            font-size:17px
        }
        div.invoice-body table th
        {
            border:0;
            border-bottom: 1px solid #d0d0d0;
            padding:20px;
            font-size:17px;
            color:#5356A5 !important
        }
        div.invoice-body table
        {

        }
        div.invoice-body div.info
        {
            background: #5356A5 !important;
            height: 40px;
            font-size:16px;
            padding: 0 80px 0 40px;
            margin-bottom: 10px;
        }
        div.invoice-body div.info p
        {
            line-height: 40px;
            color:#fff !important;
        }
        div.invoice-footer
        {
            position: absolute;
            bottom:5px;
            width: 100%;
        }
        div.invoice-footer .invoice-contact-info
        {
            padding:20px;
        }
        div.invoice-footer .invoice-contact-info
        {

        }

    </style>
    @yield('style')
    <!-- Css Files -->
    <meta charset="utf-8">
</head>
<body>
<div id="invoice">
    <div class="invoice-header text-center">
        <h3 style="font-weight: 400;color:#fff !important;">Invoice</h3>
    </div>
    <div class="invoice-info">
        <div class="col-md-6">
            @if($client)
            <p>Client Name <span>{{$client}}</span></p>
            @endif
            <p>Date <span>{{date("F j, Y")}}</span></p>
            <p>Time <span>{{date("g : i A")}}</span></p>
        </div>
        <div class="col-md-6">
            <p>Invoice No <span>{{$invoice_id}}</span></p>
            <p>Invoice Issue <span>{{$invoice_issue}}</span></p>
            <p>Employee <span>{{\Illuminate\Support\Facades\Auth::user()->name}}</span></p>
        </div>
    </div>
    <div class="watermark">
        <img src="{{asset("images/logo.png")}}">
    </div>
    <div class="invoice-body text-left">
        <h3 style="color:#5356A5 !important;font-size:20px;margin-bottom:20px;">Invoice Summary</h3>
        <table>
            <thead>
            @yield('invoice-table-titles')
            </thead>
            <tbody>
            @yield('invoice-table-body')
            </tbody>
        </table>
        <div class="col-md-6 fl-right">
            @if($total>0)
          <div class="info">
              <p class="fl-left">Total</p>
              <p class="fl-right">{{$total}}</p>
              <div class="clearfix"></div>
          </div>
            @endif
            @if($discount>0)
          <div class="info">
              <p class="fl-left">Discount</p>
              <p class="fl-right">{{$discount}}</p>
              <div class="clearfix"></div>
          </div>
            @endif
          <div class="info">
              <p class="fl-left">Paid</p>
              <p class="fl-right">{{$paid}}</p>
              <div class="clearfix"></div>
          </div>
            @if($remaining_debt>0)
                <div class="info">
                    <p class="fl-left">Debt</p>
                    <p class="fl-right">{{$remaining_debt}}</p>
                    <div class="clearfix"></div>
                </div>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="invoice-footer">
        <div class="thankyou text-center" style="padding-bottom:10px;border-bottom:1px solid #d0d0d0;">
            <h3 style="color:#5356A5 !important;font-weight: 100;font-size:90px">Thank You!</h3>
            <h3 style="color:#444 !important; font-size:16px;opacity:0.8;font-weight:600">For Choosing KillingShot</h3>
        </div>
        <div class="invoice-contact-info">
            <div class="col-md-9">
                <div class="col-md-6">
                    @foreach($places as $place)
                        <p style="font-size:12px;">
                                <b>{{$place->name}}</b>
                                <span>{{$place->address}}</span>
                    </p>
                    @endforeach
                </div>
                <div class="col-md-6">
                <p>www.kssquashacademy.com</p>
                <p>0224937144 / 01210073443</p>
                <p>info@kssquashacademy.com</p>
                </div>

            </div>
            <div class="col-md-3">
                <img width="120" src="{{asset("images/logo.png")}}">
            </div>
        </div>
    </div>
</div>
<div class="button text-center">
    <button style="margin:30px 0" id="print" data-read-only="{{$read_only}}" data-type="{{$type}}" data-id="{{$id}}" class="main-button">Print</button>
</div>
<!-- Js Files -->
<script src="{{ asset('js/jquery-3.1.0.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/jquery-ui.js')}}"></script>
<script src="{{ asset('Ajax/ErrorHandler.js') }}"></script>
<script src="{{ asset('js/print.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script>
    function HideItems() {
        HideElement('.button');
        document.title = "";
    }
    function ShowItems() {
        ShowElement('.button');
    }
$("button#print").click(function(){
    var read_only = $(this).attr('data-read-only');
    HideItems();
    print();
    ShowItems();
    if(read_only == 0) {
        type = $(this).attr('data-type');
        id = $(this).attr('data-id');
        $.ajax({
            url: "/invoice/" + type + "/" + id,
            type: "GET",
            data: {_token: $('input[name="_token"]').val()},
            success: function (data) {
//                 alert(data);
            },
            error: function (data) {
//                alert(data)
                reload(data);
//            tellme(data)
            }
        });
    }

})
</script>
@yield('script')

</body>
</html>