@extends('layouts.master')

@section('style')


@endsection

@section('title')
    {{$product->name}}
@endsection

@section('contents')
    @include('forms.products.delete')
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Product : {{$product->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('products')}}">Back To Products</a> </h5>
        </div>
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="box box-lg text-center">
                <h3 class="title rose text-left">Product Information</h3>
                @include('forms.products.main')
            </div>
            <div class="box text-center">
                <h3 class="title rose text-left">Product Picture</h3>
                @include('forms.products.picture')
            </div>
            <div class="box text-center">
                <h3 class="title rose text-left">Product Quantity</h3>
                @include('forms.products.quantity')
            </div>
            <div class="text-center">
                <button class="main-button" data-popup="delete-product-popup">Delete Product</button>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('Ajax/Product.js')}}"></script>
@endsection
