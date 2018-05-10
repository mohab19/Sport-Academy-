<div id="sell-product-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="SellProduct" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="hidden" name="id">
            <div class="col-xs-12">
                <select name="user_id" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    <option disabled selected value="">Choose User</option>
                    <option value="outside">Outside Customer?</option>
                    @foreach($users as $user)
                        <option data-subtext="{{$user->role->name}} {{$user->phone}}" value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <label class="alert" id="product_user"></label>
            </div>
            <div class="col-xs-12" style="display:none">
                <input type="text" name="name" placeholder="Customer Name">
                <label class="alert" id="product_name"></label>
            </div>
            <div class="col-md-6">
                <input type="number" name="quantity" placeholder="Quantity">
                <label class="alert" id="product_quantity"></label>
            </div>
            <div class="col-md-6">
                <input type="number" step="0.01" name="discount" placeholder="Discount">
            </div>
            <div class="col-xs-6">
                <p class="rose">Money Required : <span class="purple" id="Required"></span></p>
            </div>
            <div class="col-xs-6">
                <input type="text" name="paid" placeholder="Paid">
                <label class="alert" id="product_paid"></label>
            </div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Sell Product</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>