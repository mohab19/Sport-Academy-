<form id="UpdateProductQuantity" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{$product->id}}">
    <label class="rose" style="margin-bottom: 40px">There are <span class="purple">{{$product->quantity}}</span> of this product in the stock</label>
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <input type="number" name="quantity" placeholder="New Quantity">
        <label class="alert" id="product_quantity"></label>
    </div>
    <div class="col-xs-12">
        <input type="text" name="paid" placeholder="Total Paid Price To Buy">
        <label class="alert" id="product_paid"></label>
    </div>
    <div class="clearfix"></div>
    <div class="alert text-center"></div>
    <div class="clearfix"></div>
    <div class="text-center">
        <button class="main-button" type="submit">Increase</button>
    </div>
</form>