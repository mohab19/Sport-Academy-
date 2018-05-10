@extends('layouts.master')

@section('style')

    <style>
        .error
        {
            display:none;
            position: fixed;
            top:4px;
            left:0;
            overflow:hidden;
            width:100%;
        }
        h2,h3
        {
            margin:0
        }
        body
        {
            background:#5356A5 ;
            height: 100%;
        }
        /*form styles*/
        .msform {
            width: 100%;
            margin: 50px auto;
            text-align: center;
            position: relative;
        }
        .msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 85%;
            height:400px;
            overflow: scroll;
            margin: 0 auto;

            /*stacking fieldsets above each other*/
            position: relative;
        }
        /*Hide all except first fieldset*/
        .msform fieldset:not(:first-of-type) {
            display: none;
        }
        /*headings*/
        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
            font-weight: 700;
        }
        /*progressbar*/
        #progressbar {
            margin-top: 30px;
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }
        #progressbar li {
            list-style-type: none;
            color: white;
            text-transform: uppercase;
            font-size: 9px;
            width:20% ;
            float: left;
            position: relative;
        }
        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 20px;
            line-height: 20px;
            display: block;
            font-size: 10px;
            color: #333;
            background: white;
            border-radius: 3px;
            margin: 0 auto 5px auto;
        }
        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }
        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }
        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,  #progressbar li.active:after{
            background: #aaa;
            color: white;
        }
        label > input{ /* HIDE RADIO */
            visibility: hidden; /* Makes input not-clickable */
            position: absolute; /* Remove input from document flow */
        }
        label > input + div.player,
        label > input + div.schedule,
       div.schedulecontainer
        {
            cursor:pointer;
            border:2px solid #e0e0e0;
            transition: .4s all ease-in-out;
            padding: 5px;
        }
        label > input:checked + div.player,
        label > input:checked + div.schedule
        {
            border-color: #5356a5;
        }
        .schedule
        {
            float:left;
            margin:5px;
            border:2px solid #eee;
            padding: 5px;
        }
        .schedule h4
        {
            font-size:13px;
            margin:0;
            margin-bottom:5px;
        }
        .schedule h5
        {
            font-size:13px;
            font-weight: 700;
            margin:0;
            margin-bottom:5px;
        }    </style>
@endsection

@section('title')
    New Subscription
@endsection

@section('contents')
    <div class="error">
        <div class="alert alert-danger text-center">
            Please Choose The Right Player
        </div>
    </div>
    <div id="private">

    </div>
    @include('forms.subscriptions.add')

@endsection

@section('script')
    <script src="{{ asset('Ajax/Subscriptions.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script>
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
//            if(animating) return false;
//            animating = true;
            var ready = 1;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            switch (current_fs.attr('data-form'))
            {
                case 'player':
                    if($("input[name='player_id']:checked").length == 0)
                    {
                        ready = 0;
                        PrintOnSelector("div.error div.alert","Please Choose The Player");
                        $("div.error").show();
                    }
                    else
                    {
                        $("div.error").hide();
                        GetPlayerInfo();
                        ready = 1;
                    }
                    break;
                case 'info':
                    if($("select[name='place_id']").val() == null)
                    {
                        ready = 0;
                        PrintOnSelector("div.error div.alert","Please Fill Fields Correctly");
                        $("div.error div.alert").removeClass('alert-success').addClass('alert-danger');
                        $("div.error").show();
                    }
                    else if($("select[name='level_id']").val() == null)
                    {
                        ready = 0;
                        PrintOnSelector("div.error div.alert","Please Fill Fields Correctly");
                        $("div.error div.alert").removeClass('alert-success').addClass('alert-danger');
                        $("div.error").show();
                    }
                    else
                    {
                        $("div.error").hide();
                        ready = 1;
                    }
                    break;

                case 'schedule':
                    if($("input[name='schedules_id[]']:checked").length == 0)
                    {
                        ready = 0;
                        PrintOnSelector("div.error div.alert","Please Choose The Schedule");
                        $("div.error div.alert").removeClass('alert-success').addClass('alert-danger');
                        $("div.error").show();
                    }
                    else
                    {
                        $("div.error").hide();
                        ready = 1;
                    }
                    break;
            }
            if(ready)
            {
                //activate next step on progressbar using the index of next_fs
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50)+"%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                            'transform': 'scale('+scale+')',
//                        'position': 'absolute'
                        });
                        next_fs.css({'left': left, 'opacity': opacity});
                    },
                    duration: 500,
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    },
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });
            }

        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                },
                duration: 500,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

    </script>
    <script>
        $("input[name='discount']").change(function(){
            var discount = parseFloat($(this).val());
            var current = parseFloat($("b#RequiredMoney").text());
            $("b#RequiredMoney").text(current);
        });
        $("#SearchPlayerInput").keyup(function(){
            var filter = $(this).val();
            $(".player .text").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().parent().hide(400);
                } else {
                    $(this).parent().parent().show(400);
                }
            });
        });
        $("#SearchScheduleInput").keyup(function(){
            var filter = $(this).val();
            $(".schedule h5").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().parent().hide(400);
                } else {
                    $(this).parent().parent().show(400);
                }
            });
        });
    </script>
@endsection
