$(function () {
    var notification_time = 5000;
    getNotifications();
    function getNotifications()
    {
        if(startFlag)
        {
            $('#notifications .notifications').load('/notifications/getfeed');
            $('#notifications_number').load('/notifications/getCount');
        }

    }
    setInterval(function(){
        getNotifications()
    },notification_time);
    $(document).on('click','.AddPostButton',function() {
        startFlag = 0;
    });
    $(document).on('click',function() {
        startFlag = 1;
    });
    $("li.notifications").click(function(){
        $.ajax({
            url : '/notifications/read',
            type: 'POST',
        });

    })
        });