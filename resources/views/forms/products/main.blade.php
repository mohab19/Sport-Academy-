<form id="UpdateProductInformation" method="POST">
    <table class="table">
        <thead>
        <tr class="info">
            <th>Title</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>

        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{$product->id}}">
        <tr class="danger">
            <td>Product Name</td>
            <td>
                <div class="col-md-12">
                    <input class="sm" type="text" name="name" value="{{$product->name}}">
                    <label class="alert" id="product_name"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Product Description</td>
            <td>
                <div class="col-md-12">
                    <textarea class="sm" name="description" value="{{$product->description}}"></textarea>
                    <label class="alert" id="product_description"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Product Price</td>
            <td>
                <div class="col-md-12">
                    <input class="sm" type="text" name="price" value="{{$product->price}}">
                    <label class="alert" id="product_price"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Product Sales</td>
            <td>
                <div class="col-md-12">
                    <label class="rose">This Product has been soled <span class="purple">{{$product->sales_times}}</span> times
                    for <span class="purple">{{$product->sales_money}} LE</span>
                    </label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="clearfix"></div>
    <div class="alert text-center"></div>
    <div class="clearfix"></div>
    <div class="text-center">
        <button class="main-button" type="submit">Update</button>
    </div>
</form>