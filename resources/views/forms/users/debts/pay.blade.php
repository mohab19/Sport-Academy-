<div id="pay-debt-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
<form id="PayProductDebt" method="POST" class="text-center" action="">
    {!! csrf_field() !!}
    <div class="col-xs-12">
        <input type="text" placeholder="Value" name="paid">
        <label for="" class="alert" id="User_paid"></label>
    </div>
    <div class="col-xs-12">
        <button type="submit" class="main-button">Pay Debt</button>
    </div>
    <div class="clearfix"></div>
    <div class="alert"></div>
    <div class="clearfix"></div>
</form>
        </div>
    </div>