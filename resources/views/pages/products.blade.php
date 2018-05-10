@extends('layouts.dashboard')

@section('style')

    <style>
        .product
        {
            /*position: relative;*/
            background: #fff;
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            padding: 0;
            margin:1%;
            width:22%;
            display: inline-block;
        }
        .product .image
        {
            width:100%;
            height: 240px;
            position: relative;
        }
        .product button
        {
            margin-bottom: 5px;
        }
        .product .image img
        {
            width: 100%;
            height: 100%;
        }
        .product .back
        {
            background:rgba(83,86,165,.95);
            color:#fff;
            transition: .4s all ease-in-out;
            opacity: 0;
            position: absolute;
            top:0;
            left:0;
            width: 100%;
            height: 100%;
            padding-top: 35%;
            text-align: center;
            z-index:3
        }
        .product .back:hover
        {
            opacity: 1;
        }
        .product .caption
        {
            background: #f5f5f5;
            padding: 5px 20px;
            padding-top: 15px;
        }
        .product .caption .name
        {
            padding: 5px;
            font-size: 16px;
        }
        .product .image .price
        {
            background: #5356a5;
            padding: 10px;
            font-size: 18px;
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            margin-bottom: 5px;
            position: absolute;
            top:0;
            right:0;
            z-index:2;
        }
        #SellProduct p.rose
        {
            padding: 15px;
            font-size: 16px;
            font-weight: 500;
        }
    </style>
@endsection

@section('title')
    Products
@endsection

@section('tab')

    @include('forms.products.add')
    @include('forms.products.sell')
    <button class="main-button AddProductButton AddButton" data-popup="add-product-popup">+</button>
s
    <div class="col-xs-12">
    <input type="text" placeholder="Search Product ... " id="SearchProductInput">
    </div>
    <div class="products">
        @foreach($products as $product)
        <div class="product">
            <div class="image">
                <div class="back">
                    <a href="/product/{{$product->id}}/{{$product->name}}"><button class="main-button sm-button">View Profile</button></a>
                </div>
                @if($product->picture)
                <img src="{{$product->picture}}" alt="">
                @else
                    <img src="/images/Products/default.jpg" alt="">
                @endif
                <div class="price white">{{$product->price}} LE</div>
            </div>
            <div class="caption text-center">
                <div class="name purple">{{$product->name}}</div>
                @if($product->quantity)
                <button class="main-button sm-button SellProductButton" data-id="{{$product->id}}" data-popup="sell-product-popup">Sell</button>
                <div class="quantity rose">Remaining : {{$product->quantity}}</div>
                    @else
                    <button STYLE="obacity:0;visibility: hidden" class="main-button sm-button SellProductButton" data-id="{{$product->id}}" data-popup="sell-product-popup">Sell</button>
                    <div class="quantity rose">OUT OF STOCK</div>
                @endif
            </div>
        </div>
            @endforeach
    </div>
@endsection
@section('script')
    <script>
    </script>
    <script>
        $("#SearchProductInput").keyup(function(){
            var filter = $(this).val();
            $(".products .product .name").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().parent().hide(400);
                } else {
                    $(this).parent().parent().show(400);
                }
            });
        });
    </script>
    <script src="{{ asset('Ajax/Products.js')}}"></script>
@endsection