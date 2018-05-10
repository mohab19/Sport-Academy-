<div id="delete-product-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content">
        <form id="DeleteProduct" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{$product->id}}">
            <h3 class="purple">
                Are You Sure You Want Delete This Product?
            </h3>
            <div class="col-xs-12">
                <button type="submit" class="main-button DeleteProductButton">Delete Product</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>

        </form>
    </div>

</div>