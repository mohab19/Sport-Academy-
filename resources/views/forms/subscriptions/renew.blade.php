<div id="renew-subscription-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
<form id="RenewSubscription" method="POST" class="text-center" action="">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="">
    <div class="col-xs-12">
        <input type="text" placeholder="Paid" name="paid">
        <label for="" class="alert" id="Subscription_paid"></label>
    </div>
    <div class="col-xs-12">
        <button type="submit" class="main-button">Renew</button>
    </div>
    <div class="clearfix"></div>
    <div class="alert"></div>
    <div class="clearfix"></div>
</form>
        </div>
    </div>