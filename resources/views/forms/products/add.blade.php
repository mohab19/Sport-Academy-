<div id="add-product-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="AddProduct" method="POST" enctype="multipart/form-data" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-xs-6">
                <input type="text" name="name" placeholder="Product Name">
                <label class="alert" id="product_name"></label>
            </div>
            <div class="col-xs-6">
                <input type="number" name="quantity" placeholder="Product Quantity">
                <label class="alert" id="product_quantity"></label>
            </div>
            <div class="col-xs-6">
                <input type="text" name="price" placeholder="Unit Price To Sell">
                <label class="alert" id="product_price"></label>
            </div>
            <div class="col-xs-6">
                <input type="text" name="paid" placeholder="Total Paid Price To Buy">
                <label class="alert" id="product_paid"></label>
            </div>
            <div class="col-xs-12">
                <select title="Choose Place" name="place_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    @foreach($places as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12">
                <textarea name="description" placeholder="Product Small Description"></textarea>
                <label class="alert" id="product_description"></label>
            </div>
            <div class="col-xs-12 text-left">
                <label >Picture</label>
                <input type="file" name="picture" id="Picture">
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add Product</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>