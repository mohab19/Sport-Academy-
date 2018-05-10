<form id="UpdateProductPicture" method="POST" enctype="multipart/form-data" class="text-center" action="">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{{$product->id}}">
    @if(!$product->picture)
        <label class="rose">You don't set a picture for this product yet.</label>
        @else
        <div class="image">
            <img src="{{$product->picture}}" width="200">
        </div>
    @endif
        <div class="col-xs-12 text-center">
            <label class="" style="padding:15px">Add New Picture</label>
            <input class="fl-right" type="file" name="picture" id="Picture">
            <label id="product_picture" class="alert"></label>
        </div>
    <div class="clearfix"></div>
    <div class="alert text-center"></div>
    <div class="clearfix"></div>
    <div class="text-right"><button type="submit" class="main-button">Upload</button></div>
</form>