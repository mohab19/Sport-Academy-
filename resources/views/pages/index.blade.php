@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <style>
        .news
        {
            text-align: center;
        }
        .news .item
        {
            height:303px;
            width:95%;
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            display: inline-block;
        }
        .news .item .image
        {
            height: 200px;
            width: 100%;
        }
        .item .image img
        {
            width:100%;
            height:100%;
        }
        .news .item .caption
        {
            height: 100px;
            width: 100%;
            background: #fff;
            box-shadow: 0px 5px 7px 0px #a8a8a8;
            padding: 10px;
        }
        .news .item .caption p
        {
            height:50px;
            overflow: hidden;
            font-size: 18px;
            text-transform: none !important;
            word-break: break-all;
            text-overflow:ellipsis
        }
        nav a
        {
            color:#fff !important;
        }
    </style>
@endsection

@section('title')
   Home Page
@endsection

@section('contents')
    <!-- Start Navbar -->
    <nav class="navbar navbar-fixed-top" id="nav">
        <div class="container"> <!-- start container -->
            <div class="row"> <!-- staer row -->
                <div class="col-xs-12">
                    <!-- Brand and toggle get grouped for better ile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed"  data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                            <i class="fa fa-bars purple" style="font-size: 24px; font-weight:bold;" aria-hidden="true"></i>
                        </button>
                        <a class="navbar-brand" href="#header">
                            <img alt="Brand" width="60  " src="{{ asset('images/logo.png') }}"> <!-- logo -->
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav navbar-right"> <!-- nav -->
                            <li class="active"><a href="#header" class="white">Home</a></li>
                            <li><a href="#about" class="white" >About</a></li>
                            <li><a href="#programs" class="white" >Programs</a></li>
                            <li><a href="#join-academy" class="white" >Join Academy</a></li>
                            <li><a href="#gallery" class="white" >Gallery</a></li>
                            <li><a href="#sponsors" class="white" >Sponsors</a></li>
                            <li><a href="#news" class="white" >News</a></li>
                            <li><a href="#footer" class="white" >Contact</a></li>
                            @if(Auth::check())
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$user->full_name }}<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ URL::route('dashboard') }}">Control Panel</a></li>
                                        <li><a href="{{ URL::route('logout') }}">Logout</a></li>
                                    </ul>
                                </li>

                            @else
                            <li data-popup="sign-in-popup"><a href="#sign-in" class="white" >sign in</a></li> <!-- sign-in-popup -->
                            <li data-popup="sign-up-popup"><a href="#sign-up" class="white" >sign up</a></li> <!-- sign-up-popup -->
                            @endif
                        </ul> <!-- nav -->
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </nav>
    <!-- End Navbar -->
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <!-- Start Header -->
    <header id="header">
        <div class="container"> <!-- star container -->
            <div class="row"> <!-- start row -->

                <div class="header-content">
                    <div class="col-xs-12 col-sm-5">
                        <img src="images/traccia-giocatore.png"/>
                    </div>
                    <div class="col-xs-12 col-sm-7 white">
                        <h1 class="title"><strong>killing shot<br/>academy</strong></h1> <!-- title -->
                        <p>a junior and senior academy for all ages, genders and
                            abilities.</p>
                        <button type="button" class="main-button"><a href="#about" class="white">get started</a></button> <!-- main-button -->
                    </div>
                </div> <!-- header content -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </header>
    <!-- End Header -->
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <!-- Start About -->
    <section id="about">
        <div class="container"> <!-- start container -->
            <div class="row"> <!-- star row -->

                <div class="col-md-5">
                    <h2 class="purple">
                        <strong>who<br/>we<br/>are<br/></strong>
                        <hr class="short-hr fl-left"/>
                    </h2>
                </div>

                <div class="col-md-7">
                    <h3 class="dark-gray">
                        <strong>welcom to killing shot</strong>
                    </h3>
                    <hr class="long-hr fl-left"/>
                    <p class="gray" dir="rtl">كيلنج شوت مؤسسة رياضيه كبيرة تدير اكاديمية كيلنج شوت للاسكواش والتى تنقسم لفرعين فى القاهره
                        <br>                        1- نادى طلائع الجيش (بمصر الجديدة )
                        <br>                        2- فرع فندق توليب النرجس ( بالتجمع الاول )
                        <br>                        وتتيح الاكاديمية فرصه التدريب لاى طفل من عمر 5 سنوات وحتى اى سن والمشاركة فى البطولات المقامة التابعة للاتحاد المصرى للاسكواش باسم نادى طلائع الجيش والدورى العام باسم نادى طلائع الجيش وتنميه المستويات عن طريق افضل المدربين للاسكواش والفوت ورك والفتنس وتوفير دكتور للتغذيه ودكتور تحليل نفسى وعمل ايام للتدريبات الجماعية للفريق والوقوف على مستويات اللاعبين وتضم الاكاديمية جهاز ادارى لجميع الفروع والفريق معا يتكون من
                        <br>                        1- ك / احمد سراج (المدير العام للاكاديمية والمدير الفنى لنادى طلائع الجيش ) 01009983992
                        <br>                        2- دكتور طه محمود ( المدير التنفيذى اللاكاديمية ) 01011127767
                        <br>                        3- ك/ مصطفى راضى ( مدير ادارى لجميع الفروع وادارى فريق نادى طلائع الجيش ) 01007435135
                        4- ك / احمد محمود ( ادارى فرع الجيش ) <br>01017111799
                        5 - ك / معتز عرفان ( ادارى فرع توليب ) <br>01017146668
                    </p>
                </div>

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- End About -->
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <!-- Start Programs -->
    <section id="programs">
        <div class="container"> <!-- star container -->
            <div class="row"> <!-- start row -->

                <div class="col-md-5">
                    <h2 class="purple"><strong>what<br/>we<br/>do<br/></strong>
                        <hr class="short-hr fl-left"/>
                    </h2>
                </div>
                <div class="col-md-7">

                    <div class="col-xs-1">
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>Private training</strong></h4>
                    </div>
                    <div class="col-xs-1">
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>Games</strong></h4>
                    </div>
                    <div class="col-xs-1">
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>Fitness training </strong></h4>
                    </div>
                    <div class="col-xs-1">
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>Mental doctor</strong></h4>
                    </div>
                    <div class="col-xs-1">
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>Strokes</strong></h4>
                    </div>

                </div>

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- End Programs -->
    <!-- Start About -->
    {{--<section id="crew">--}}
        {{--<div class="container"> <!-- start container -->--}}
            {{--<div class="row"> <!-- star row -->--}}

                {{--<div class="col-md-5">--}}
                    {{--<h2 class="purple">--}}
                        {{--<strong>Our<br/>Professional<br/>Coaches<br/></strong>--}}
                        {{--<hr class="short-hr fl-left"/>--}}
                    {{--</h2>--}}
                {{--</div>--}}

                {{--<div class="col-md-7">--}}
                    {{--<div id="CoachesSlider" class="owl-carousel owl-theme col-xs-12 wow bounceIn ">--}}
                        {{--<div class="item text-center">--}}
                            {{--<div class="back">--}}
                                {{--<p class="">--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus.--}}
                                {{--</p>--}}
                                {{--</div>--}}
                            {{--<div class="image">--}}
                           {{--<img src="images/coach.jpg">--}}
                                {{--</div>--}}
                            {{--<div class="text">--}}
                                {{--<h4 class="purple">Coach Name</h4>--}}
                                {{--<h5 class="gray">Coach Job</h5>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="item text-center">--}}
                            {{--<div class="back">--}}
                                {{--<p class="">--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus.--}}
                                {{--</p>--}}
                                {{--</div>--}}
                            {{--<div class="image">--}}
                           {{--<img src="images/coach.jpg">--}}
                                {{--</div>--}}
                            {{--<div class="text">--}}
                                {{--<h4 class="purple">Coach Name</h4>--}}
                                {{--<h5 class="gray">Coach Job</h5>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="item text-center">--}}
                            {{--<div class="back">--}}
                                {{--<p class="">--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus.--}}
                                {{--</p>--}}
                                {{--</div>--}}
                            {{--<div class="image">--}}
                           {{--<img src="images/coach.jpg">--}}
                                {{--</div>--}}
                            {{--<div class="text">--}}
                                {{--<h4 class="purple">Coach Name</h4>--}}
                                {{--<h5 class="gray">Coach Job</h5>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="item text-center">--}}
                            {{--<div class="back">--}}
                                {{--<p class="">--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus--}}
                                    {{--lorem ipsum dolor sit amet consect,--}}
                                    {{--enture aliguam tinciduntmauris eu risus.--}}
                                {{--</p>--}}
                                {{--</div>--}}
                            {{--<div class="image">--}}
                           {{--<img src="images/coach.jpg">--}}
                                {{--</div>--}}
                            {{--<div class="text">--}}
                                {{--<h4 class="purple">Coach Name</h4>--}}
                                {{--<h5 class="gray">Coach Job</h5>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                {{--</div>--}}

            {{--</div> <!-- end row -->--}}
        {{--</div> <!-- end container -->--}}
    {{--</section>--}}
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <!-- Start Join-Academy  -->
    <section id="join-academy" >
        <div class="container"> <!-- srart container -->
            <div class="row"> <!-- star row -->

                <div class="col-md-5">
                    <h2 class="purple"><strong>how<br/>to join<br/>us<br/></strong>
                        <hr class="short-hr fl-left"/>
                    </h2>
                </div>

                <div class="col-md-7">

                    <div class="col-xs-1">
                        <img src="images/icon_requirement.png"/>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>main requirements</strong></h4>
                        <ul class="list-unstyled">
                            <li><p class="gray">1- Cras justo odio</p></li>
                            <li><p class="gray">2- Dapibus ac facilisis in</p></li>
                            <li><p class="gray">3- Morbi leo risus</p></li>
                            <li><p class="gray">4- Porta ac consectetur ac</p></li>
                            <li><p class="gray">5- Vestibulum at eros</p></li>
                        </ul>
                    </div>

                    <div class="col-xs-1">
                        <img src="images/paper_documents_business_icon_finance_icon.png"/>
                    </div>
                    <div class="col-xs-11">
                        <h4 class="dark-gray"><strong>paper needed</strong></h4>
                        <ul class="list-unstyled">
                            <li><p class="gray">1- Cras justo odio</p></li>
                            <li><p class="gray">2- Dapibus ac facilisis in</p></li>
                            <li><p class="gray">3- Morbi leo risus</p></li>
                        </ul>
                    </div>

                </div>

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- End Join-Academy -->
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <!-- Start Gallery -->
    <section id="gallery">
        <div class="container"> <!-- srart container -->
            <div class="row"> <!-- star row -->

                <div class="col-md-5">
                    <h2 class="purple"><strong>our<br/>amazing<br/>moments<br/></strong>
                        <hr class="short-hr fl-left"/>
                    </h2>
                </div>

                <div class="col-md-7">
                    <!-- start slideshow -->
                    <div id="mycarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">

                            <div class="item active">
                                <img src="images/Gallery/4.jpg"/>
                            </div>
                            <div class="item">
                                <img src="images/Gallery/3.jpg"/>
                            </div>
                            <div class="item">
                                <img src="images/Gallery/1.jpg"/>
                            </div>
                            <div class="item">
                                <img src="images/Gallery/2.jpg"/>
                            </div>

                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
                            <img src="images/BziX7M7cB.png"/>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
                            <img src="images/BziX7M7cB.png"/>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!-- End slideshow -->
                </div>

            </div>

        </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- End Gallery -->
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <section id="sponsors">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="purple"><strong>our<br/>awesome<br/>sponsors<br/></strong>
                        <hr class="short-hr fl-left"/>
                    </h2>
                </div>
                <div class="col-md-7">
                        @foreach($sponsors as $sponsor)
                        <img src="{{$sponsor->picture}}" class="img-rounded" width="300">
                            @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="news">
        <div class="container">
            <div class="row">
                <div class="news">
                    <div class="owl-carousel">
                    @foreach($news as $item)
                        <div class="item">
                            <div class="image">
                                <img src="{{$item->cover}}">
                            </div>
                            <div class="caption">
                                <p>{{$item->title}}</p>
                                <div>
                                    <a href="/news/{{$item->id}}/{{$item->title}}" class="rose fl-right"><b>Read More >></b></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Footer-->
    <footer id="footer" >
        <div class="container"> <!-- srart container -->
            <div class="row"> <!-- star row -->

                <div class="col-md-5">
                    <h2 class="white"><strong>how<br/>to find<br/>us<br/></strong>
                        <hr class="short-hr fl-left"/>
                    </h2>
                </div>

                <div class="col-md-7 text-center">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.48750935627!2d31.30452808539006!3d30.080221381869254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fc98675cf95%3A0x91ceadef475a98a6!2z2YbYp9iv2Yog2LfZhNin2KbYuSDYp9mE2KzZiti0!5e0!3m2!1sar!2s!4v1499163912943"
                                            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                                <div class="item">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.4891904066817!2d31.46732898569623!3d30.022820481890136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145822ddb4b7cbe5%3A0xb6a9a91115535dcf!2z2YHZhtiv2YIg2KrZiNmE2YrYqCDYp9mE2YbYsdis2LM!5e0!3m2!1sar!2seg!4v1499164357085"
                                            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-12 ">
                        <div class="social-media">
                            <ul class="list-unstyled list-inline ">

                                <li>
                                    <a href="#" target="_blank" style="color:#3d5a98">
                                        <i class="fa fa-facebook-square fl-left" aria-hidden="true"></i>
                                        <h5 class="fl-right">Find us on<br/><strong>FACEBOOK</strong></h5>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" target="_blank" style="color:#00abf1">
                                        <i class="fa fa-twitter-square fl-left" aria-hidden="true"></i>
                                        <h5 class="fl-right">Find us on<br/><strong>TWITTER</strong></h5>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" target="_blank" style="color:#cf2200">
                                        <i class="fa fa-youtube-square fl-left" aria-hidden="true"></i>
                                        <h5 class="fl-right">Find us on<br/><strong>YOUTUBE</strong></h5>
                                    </a>
                                </li>

                            </ul>
                        </div> <!-- social-media -->
                    </div>



                    <div class="col-md-12"> <!-- send-message -->
                        <button type="button" class="main-button text-center" data-popup="send-message-popup">
                            <a href="#send-message-popup" class="white">send message</a>
                        </button>
                    </div>

                </div>

            </div> <!-- end row -->
        </div> <!-- end container -->
    </footer>
    <!-- End Footer-->
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <!-- Send Message -->
    <div id="send-message-popup" class="popup">
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="col-sm-5">
            <h2 class="purple"><strong>feel<br/>free<br/>to ask<br/></strong>
                <hr class="short-hr fl-left"/>
            </h2>
        </div>

        <div class="col-sm-7 popup-content">
            <form id="send-message" method="POST" class="text-center" action="">
                <div class="col-xs-12">
                    <input type="text" name="name" placeholder="Full Name" id="name">
                </div>
                <div class="col-xs-12">
                    <input type="email" name="email" placeholder="Email" id="email">
                </div>
                <div class="col-xs-12">
                    <textarea type="text" name="message" placeholder="What do you want to ask ?" id="message"></textarea>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button"><a href="#" class="white">send message</a></button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <!-- Send Message -->
    <!-- ---------------------------------------------------------------------------------------------------------------------->
    <!-- Sign In -->
    <div id="sign-in-popup" class="popup">
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

        <div class="col-sm-6">
            <h2 class="purple"><strong>back<br/>to<br/>account<br/></strong>
                <hr class="short-hr fl-left"/>
            </h2>
        </div>

        <div class="col-sm-6 popup-content">
            <form id="login" class="text-center">
                {!! csrf_field() !!}
                <div class="col-xs-12">
                    <input type="text" name="username" placeholder="Username">
                    <label class="alert" id="username_error"></label>
                </div>
                <div class="col-xs-12">
                    <input type="password" name="password" placeholder="Password">
                    <label class="alert"  id="password_error"></label>
                </div>
                <div class="text-center col-md-6 col-xs-12">
                    <input name="remember" id="rememeber" class="fl-left" type="checkbox">
                    <label for="rememeber" class="fl-left" style="margin-left:2px;font-size:14px;">Remember Me</label>
                </div>
                <div class="col-xs-6">
                    <div><a href="" class="dark-gray">Forget Password</a></div>
                </div>
                <div class="col-xs-12">
                    <button type="submit" class="main-button">
                        Signin
                    </button>
                </div>
                <div class="clearfix"></div>
                <div class="alert"></div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <!-- Sign In -->
    <!-- ---------------------------------------------------------------------------------------------------------------------->
    <!-- Sign Up -->
    <div id="sign-up-popup" class="popup">
        <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
        <div class="col-sm-12 popup-content">
            @include('forms.players.registration')
        </div>

    </div>
    <!-- Sign Up -->
    <!-- ---------------------------------------------------------------------------------------------------------------------->
    <!-- Success Alert -->
    <div id="success-alert-popup" class="popup">
        <div class="text-center">
            <i class="fa fa-check-square-o" aria-hidden="true" style="color:#39b54a"></i>
            <div class="alert alert-success" role="alert" style="background-color: #a2ffa5;">operation done successfully</div>
            <button type="button" class="main-button"><a href="#" class="white">continue</a></button>
        </div>
    </div>
    <!-- Success Alert -->
    <!-- ---------------------------------------------------------------------------------------------------------------------->
    <!-- Failed Alert -->
    <div id="failed-alert-popup" class="popup">
        <div class="text-center">
            <i class="fa fa-frown-o" aria-hidden="true" style="color:#d25b60"></i>
            <div class="alert alert-danger" role="alert" style="background-color:#d25b60;">something is wrong!</div>
            <button type="button" class="main-button fl-left" style="margin-right:10px;"><a href="#" class="white">try again</a></button>
            <button type="button" class="main-button fl-right"><a href="#" class="white">continue</a></button>
        </div>
    </div>
    <!-- Failed Alert -->
    <!-- ---------------------------------------------------------------------------------------------------------------------->

    <!-- ---------------------------------------------------------------------------------------------------------------------->


@endsection

@section('script')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Ajax/Login.js') }}"></script>
    <script src="{{ asset('Ajax/Registration.js') }}"></script>

    <script>
        var NewsSlider = $(".owl-carousel");
        NewsSlider.owlCarousel({
            items : 3, //10 items above 1000px browser width
            itemsDesktop : [1000,3], //5 items between 1000px and 901px
            itemsDesktopSmall : [900,3], // betweem 900px and 601px
            itemsTablet: [600,1], //2 items between 600 and 0
            paginationNumbers:true
        });
    </script>
    <script>
        $("input[name='firsttime']").change(function(){
            waiting();
            if($(this).val() == "no")
            $("#not_first_time").fadeIn();
            else
                $("#not_first_time").fadeOut();
            finish();
        });
    </script>
    <script>
        $("marquee").insertAfter("header")
    </script>
@endsection
