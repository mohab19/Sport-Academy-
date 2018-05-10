<div id="delete-subscription-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content">
        <form id="DeleteSubscription" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="text"  name="id" class="hidden">
            <h3 class="purple">
                How do you want to delete this Subscription
            </h3>
            <div class="text-center">
            <div class="col-md-12 text-left">
                <input type="radio" value="soft" name='type'>Soft Delete (Recommended)<br>
                <p>keep in reports</p>
            </div>
            <div class="col-md-12 text-left">
                <input type="radio" value="force" name='type'>Force Delete <br>
                <p>delete from reports</p>
            </div>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Delete Subscription</button>
            </div>


        </form>
    </div>

</div>