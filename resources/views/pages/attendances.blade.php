@extends('layouts.dashboard')

@section('style')

    <style>
        .checkbox {
            display:inline-block;
            position:relative;
            text-align:left;
            width:60px;
            height:30px;
            background-color:#eee;
            overflow:hidden;
            box-shadow:inset 0 10px 25px rgba(0,0,0, .5), 0px 1px 2px #fff;
            -webkit-border-radius:20px;
            -moz-border-radius:20px;
            border-radius:20px;
            margin:10px;
        }

        .checkbox input {
            display: block;
            position: absolute !important;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            margin: 0 0 !important;
            cursor: pointer !important;
            opacity: 0;
            filter: alpha(opacity=0);
            z-index: 2;
        }

        .checkbox label {
            background-color:#151b29;
            background-image:-webkit-linear-gradient(-40deg,rgba(0,0,0,0),rgba(255,255,255,0.1),rgba(0,0,0,0.2));
            background-image:-moz-linear-gradient(-40deg,rgba(0,0,0,0),rgba(255,255,255,0.1),rgba(0,0,0,0.2));
            background-image:-ms-linear-gradient(-40deg,rgba(0,0,0,0),rgba(255,255,255,0.1),rgba(0,0,0,0.2));
            background-image:-o-linear-gradient(-40deg,rgba(0,0,0,0),rgba(255,255,255,0.1),rgba(0,0,0,0.2));
            background-image:linear-gradient(-40deg,rgba(0,0,0,0),rgba(255,255,255,0.1),rgba(0,0,0,0.2));
            -webkit-box-shadow:0 0 0 1px rgba(0,0,0,0.1),0 1px 2px rgba(0,0,0,0.7);
            -moz-box-shadow:0 0 0 1px rgba(0,0,0,0.1),0 1px 2px rgba(0,0,0,0.7);
            box-shadow:0 0 0 1px rgba(0,0,0,0.1),0 1px 2px rgba(0,0,0,0.7);
            -webkit-border-radius:20px;
            -moz-border-radius:20px;
            border-radius:20px;
            display:inline-block;
            width:30px;
            text-align:center;
            font:bold 10px/28px Arial,Sans-Serif;
            color:#999;
            text-shadow:0 -1px 0 rgba(0,0,0,0.7);
            -webkit-transition:margin-left 0.2s ease-in-out;
            -moz-transition:margin-left 0.2s ease-in-out;
            -ms-transition:margin-left 0.2s ease-in-out;
            -o-transition:margin-left 0.2s ease-in-out;
            transition:margin-left 0.2s ease-in-out;
            margin:1px;
        }

        .checkbox label:before {
            content:attr(data-off);
        }

        .checkbox input:checked + label {
            margin-left:29px;
            /* green when 'on'
            background-color: #429f21;
            */

            /* blue when 'on' */
            background-color: #5356a5;

            color:white;
        }

        .checkbox input:checked + label:before {
            content:attr(data-on);
        }
        .checkbox label, .radio label
        {
            padding-left:2px;
        }
    </style>
@endsection

@section('title')
    Attendances
@endsection

@section('tab')
    <div class="col-xs-12">
        <input type="text" placeholder="Search ..." id="SearchUserInput">
    </div>
        <div class="box box-lg col-md-12">
            <h3 class="title rose">Day : {{date("l")}}</h3>
                @include('forms.attendances.add')
        </div>
    @endsection
@section('script')
    <script src="{{ asset('Ajax/Attendances.js')}}"></script>
    <script>
        $("#SearchUserInput").keyup(function(){
            var filter = $(this).val();
            $("td.name").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parent().hide(400);
                } else {
                    $(this).parent().show(400);
                }
            });
        });
    </script>
@endsection