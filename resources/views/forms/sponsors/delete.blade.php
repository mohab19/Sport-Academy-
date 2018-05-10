<div id="delete-sponsor-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="DeleteSponsor" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <h3 class="purple">
                Are You Sure You Want Delete This Sponsor?
            </h3>
            <div class="col-xs-12">
                <button type="submit" class="main-button DeleteProductButton">Delete Sponsor</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
        </form>
    </div>

</div>