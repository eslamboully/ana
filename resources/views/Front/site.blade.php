<!doctype html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="no-js" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>لوحة التحكم</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ url('Front')}}/assets/images/favicon.png" type="image/png">

    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/animate.css">

    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/magnific-popup.css">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/slick.css">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/LineIcons.css">

    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/font-awesome.min.css">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/bootstrap.min.css">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/default.css">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ url('Front')}}/assets/css/style.css">

</head>

<body>
<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->


<!--====== PRELOADER PART START ======-->

<div class="preloader">
    <div class="loader">
        <div class="ytp-spinner">
            <div class="ytp-spinner-container">
                <div class="ytp-spinner-rotator">
                    <div class="ytp-spinner-left">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                    <div class="ytp-spinner-right">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== PRELOADER PART ENDS ======-->

<!--====== HEADER PART START ======-->

<header class="header-area">
    <div class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('site') }}">
                            <img src="{{ url('Front')}}/assets/images/logo2.png">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="#home">@lang('front.dashboard')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#features">@lang('front.features')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#about">@lang('front.about_system')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#facts">@lang('front.facts')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('lang',__('front.lang')) }}">@lang('front.language')</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <a class="main-btn" data-scroll-nav="0" href="{{ route('login') }}">@lang('front.login_menu')</a>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- navbar area -->

    <div id="home" class="header-hero bg_cover" style="background-image: url('{{ url('Front/assets/images/banner-bg.svg') }}')">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="header-hero-content text-center">
                        <h3 class="header-sub-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">@lang('front.first_slider')</h3>
                        <h2 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">@lang('front.second_slider')</h2>
                        <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">@lang('front.third_slider')</p>

                        <center><div>
                                <a href="https://www.apple.com/"><img src="{{ url('Front')}}/assets/images/apple.png" alt="Girl in a jacket" width="140" height="63" ></a>
                                <a href="https://www.google.com/"><img src="{{ url('Front')}}/assets/images/google.png" alt="Girl in a jacket" width="140" height="65"></a>
                            </div></center>


                        <!-- <a href="#" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Get Started</a>
                        <a class="main-btn" data-scroll-nav="0" href="http://www.cpanel.ae/login">Log In / Sign Up</a> -->
                    </div> <!-- header hero content -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                        <img src="{{ url('Front')}}/assets/images/header-hero.png" alt="Cpanel">
                    </div> <!-- header hero image -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div id="particles-1" class="particles"></div>
    </div> <!-- header hero -->
</header>

<!--====== HEADER PART ENDS ======-->

<!--====== BRAMD PART START ======-->

<div class="brand-area pt-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-logo d-flex align-items-center justify-content-center justify-content-md-between">
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <img src="{{ url('Front')}}/assets/images/brand-1.png" alt="brand">
                    </div> <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <img src="{{ url('Front')}}/assets/images/brand-2.png" alt="brand">
                    </div> <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
                        <img src="{{ url('Front')}}/assets/images/brand-3.png" alt="brand">
                    </div> <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.4s">
                        <img src="{{ url('Front')}}/assets/images/brand-4.png" alt="brand">
                    </div> <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="{{ url('Front')}}/assets/images/brand-5.png" alt="brand">
                    </div> <!-- single logo -->
                </div> <!-- brand logo -->
            </div>
        </div>   <!-- row -->
    </div> <!-- container -->
</div>

<!--====== BRAMD PART ENDS ======-->

<!--====== SERVICES PART START ======-->

<section id="features" class="services-area pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-title text-center pb-40">
                    <div class="line m-auto"></div>
                    <h3 class="title">@lang('front.second_services')<span>@lang('front.first_services')</span></h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7 col-sm-8">
                <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="services-icon">
                        <img class="shape" src="{{ url('Front')}}/assets/images/services-shape.svg" alt="shape">
                        <img class="shape-1" src="{{ url('Front')}}/assets/images/services-shape-1.svg" alt="shape">
                        <i class="lni-baloon"></i>
                    </div>
                    <div class="services-content mt-30">
                        <h4 class="services-title"><a href="#">@lang('front.proj_files')</a></h4>
                        <p class="text">@lang('front.proj_files_desc')</p>
                        <a class="more" href="#">@lang('front.setup_now')<i class="lni-chevron-right"></i></a>
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-7 col-sm-8">
                <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="services-icon">
                        <img class="shape" src="{{ url('Front')}}/assets/images/services-shape.svg" alt="shape">
                        <img class="shape-1" src="{{ url('Front')}}/assets/images/services-shape-2.svg" alt="shape">
                        <i class="lni-cog"></i>
                    </div>
                    <div class="services-content mt-30">
                        <h4 class="services-title"><a href="#">@lang('front.discuss')</a></h4>
                        <p class="text">@lang('front.discuss_desc')</p>
                        <a class="more" href="#">@lang('front.setup_now')<i class="lni-chevron-right"></i></a>
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-7 col-sm-8">
                <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                    <div class="services-icon">
                        <img class="shape" src="{{ url('Front')}}/assets/images/services-shape.svg" alt="shape">
                        <img class="shape-1" src="{{ url('Front')}}/assets/images/services-shape-3.svg" alt="shape">
                        <i class="lni-bolt-alt"></i>
                    </div>
                    <div class="services-content mt-30">
                        <h4 class="services-title"><a href="#">@lang('front.sys')</a></h4>
                        <p class="text">@lang('front.sys_desc')</p>
                        <a class="more" href="#">@lang('front.setup_now')<i class="lni-chevron-right"></i></a>
                    </div>
                </div> <!-- single services -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== SERVICES PART ENDS ======-->

<!--====== ABOUT PART START ======-->

<section id="about" class="about-area pt-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <div class="line"></div>
                        <h3 class="title">@lang('front.ctrl_panel')<span>@lang('front.show_mu')</span></h3>
                    </div> <!-- section title -->
                    <p class="text">@lang('front.show_mu_desc')</p>
                    <a href="#" class="main-btn">@lang('front.try_free')</a>
                </div> <!-- about content -->
            </div>
            <div class="col-lg-6">
                <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="{{ url('Front')}}/assets/images/about1.svg" alt="about">
                </div> <!-- about image -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="about-shape-1">
        <img src="{{ url('Front')}}/assets/images/about-shape-1.svg" alt="shape">
    </div>
</section>

<!--====== ABOUT PART ENDS ======-->

<!--====== ABOUT PART START ======-->

<section class="about-area pt-70">
    <div class="about-shape-2">
        <img src="{{ url('Front')}}/assets/images/about-shape-2.svg" alt="shape">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-lg-last">
                <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <div class="line"></div>
                        <h3 class="title">@lang('front.ctrl_panel')<span>@lang('front.panels')</span></h3>
                    </div> <!-- section title -->
                    <p class="text">@lang('front.panels_desc')</p>
                    <a href="#" class="main-btn">@lang('front.try_free')</a>
                </div> <!-- about content -->
            </div>
            <div class="col-lg-6 order-lg-first">
                <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="{{ url('Front')}}/assets/images/about2.svg" alt="about">
                </div> <!-- about image -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>


<!--====== ABOUT PART START ======-->

<section class="about-area pt-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <div class="line"></div>
                        <h3 class="title"><span>@lang('front.created_fro')</span> @lang('front.company_dreams')</h3>
                    </div> <!-- section title -->
                    <p class="text">@lang('front.company_dreams_desc')</p>
                    <a href="#" class="main-btn">@lang('front.try_free')</a>
                </div> <!-- about content -->
            </div>
            <div class="col-lg-6">
                <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="{{ url('Front')}}/assets/images/about3.svg" alt="about">
                </div> <!-- about image -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="about-shape-1">
        <img src="{{ url('Front')}}/assets/images/about-shape-1.svg" alt="shape">
    </div>
</section>

<!--====== ABOUT PART ENDS ======-->


<!--====== ABOUT PART ENDS ======-->

<!--====== VIDEO COUNTER PART START ======-->

<section id="facts" class="video-counter pt-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="video-content mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="video-wrapper">
                        <div class="video-image">
                            <img src="{{ url('Front')}}/assets/images/header-hero.png" alt="cpanel">
                        </div>

                    </div> <!-- video wrapper -->
                </div> <!-- video content -->
            </div>
            <div class="col-lg-6">
                <div class="counter-wrapper mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                    <div class="counter-content">
                        <div class="section-title">
                            <div class="line"></div>
                            <h3 class="title">حقائق مدهشة <span>@lang('front.about_cpanel')</span></h3>
                        </div> <!-- section title -->
                        <p class="text">@lang('front.about_cpanel_desc')</p>
                    </div> <!-- counter content -->
                    <div class="row no-gutters">
                        <div class="col-4">
                            <div class="single-counter counter-color-1 d-flex align-items-center justify-content-center">
                                <div class="counter-items text-center">
                                    <span class="count"><span class="counter">1440</span>@lang('front.hours')</span>
                                    <p class="text">@lang('front.progs')</p>
                                </div>
                            </div> <!-- single counter -->
                        </div>
                        <div class="col-4">
                            <div class="single-counter counter-color-2 d-flex align-items-center justify-content-center">
                                <div class="counter-items text-center">
                                    <span class="count"><span class="counter">167</span>@lang('front.hours')</span>
                                    <p class="text">@lang('front.progs')</p>
                                </div>
                            </div> <!-- single counter -->
                        </div>
                        <div class="col-4">
                            <div class="single-counter counter-color-3 d-flex align-items-center justify-content-center">
                                <div class="counter-items text-center">
                                    <span class="count"><span class="counter">90</span>@lang('front.hours')</span>
                                    <p class="text">@lang('front.test')</p>
                                </div>
                            </div> <!-- single counter -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- counter wrapper -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== VIDEO COUNTER PART ENDS ======-->


<footer id="footer" class="footer-area pt-120">
    <div class="container">
        <div class="subscribe-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="row">
                <div class="col-lg-6">
                    <div class="subscribe-content mt-45">
                        <h2 class="subscribe-title">@lang('front.subscribe_desc') <span>@lang('front.subscribe_desc_two')</span></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subscribe-form mt-50">
                        <form action="#">
                            <input type="text" placeholder="Enter eamil">
                            <button class="main-btn">@lang('front.subscribe')</button>
                        </form>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- subscribe area -->
        <div class="footer-widget pb-100">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="footer-about mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <a class="logo" href="#">
                            <img src="{{ url('Front')}}/assets/images/foot.png" alt="logo">
                        </a>
                        <p class="text">@lang('front.desc_footer')</p>
                        <!-- <ul class="social">
                            <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
                            <li><a href="#"><i class="lni-instagram-filled"></i></a></li>
                            <li><a href="#"><i class="lni-linkedin-original"></i></a></li>
                        </ul> -->
                    </div> <!-- footer about -->
                </div>
                <div class="col-lg-5 col-md-7 col-sm-7">
                    <div class="footer-link d-flex mt-50 justify-content-md-between">
                        <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                            <div class="footer-title">
                                <h4 class="title">@lang('front.footer_fast_links')</h4>
                            </div>
                            <ul class="link">
                                <li><a href="#">@lang('front.dashboard')</a></li>
                                <li><a href="#">@lang('front.features')</a></li>
                                <li><a href="#">@lang('front.about_system')</a></li>
                                <li><a href="#">@lang('front.why_dd')</a></li>
                                <li><a href="#">@lang('front.login')</a></li>
                            </ul>
                        </div> <!-- footer wrapper -->
                        <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s">
                            <div class="footer-title">
                                <h4 class="title">@lang('front.ghazal')</h4>
                            </div>
                            <ul class="link">
                                <li><a href="#">@lang('front.systems')</a></li>
                                <li><a href="#">@lang('front.advice_for_you')</a></li>
                                <li><a href="#">@lang('front.how_cat')</a></li>
                                <li><a href="#">@lang('front.service_f')</a></li>
                                <li><a href="#">@lang('front.contact_us')</a></li>
                            </ul>
                        </div> <!-- footer wrapper -->
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-3 col-md-5 col-sm-5">
                    <div class="footer-contact mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                        <div class="footer-title">
                            <h4 class="title">@lang('front.contact_us')</h4>
                        </div>
                        <ul class="contact">
                            <li>+97165552588</li>
                            <li>contact@ghazaluae.com</li>
                            <li>www.ghazaluae.com</li>
                            <li>@lang('front.ssh')<br> @lang('front.arab_motahida')</li>
                        </ul>
                    </div> <!-- footer contact -->
                </div>
            </div> <!-- row -->
        </div> <!-- footer widget -->
        <div class="footer-copyright">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright d-sm-flex justify-content-between">
                        <div class="copyright-content">
                            <p class="text">@lang('front.tm_tasmim') <a href="http://ghazaluae.com" rel="nofollow">@lang('front.tm_tasmim_2')</a></p>
                        </div> <!-- copyright content -->
                    </div> <!-- copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- footer copyright -->
    </div> <!-- container -->
    <div id="particles-2"></div>
</footer>

<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TOP TOP PART START ======-->

<a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

<!--====== BACK TOP TOP PART ENDS ======-->

<!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->

<!--====== PART ENDS ======-->




<!--====== Jquery js ======-->
<script src="{{ url('Front')}}/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="{{ url('Front')}}/assets/js/vendor/modernizr-3.7.1.min.js"></script>

<!--====== Bootstrap js ======-->
<script src="{{ url('Front')}}/assets/js/popper.min.js"></script>
<script src="{{ url('Front')}}/assets/js/bootstrap.min.js"></script>

<!--====== Plugins js ======-->
<script src="{{ url('Front')}}/assets/js/plugins.js"></script>

<!--====== Slick js ======-->
<script src="{{ url('Front')}}/assets/js/slick.min.js"></script>

<!--====== Ajax Contact js ======-->
<script src="{{ url('Front')}}/assets/js/ajax-contact.js"></script>

<!--====== Counter Up js ======-->
<script src="{{ url('Front')}}/assets/js/waypoints.min.js"></script>
<script src="{{ url('Front')}}/assets/js/jquery.counterup.min.js"></script>

<!--====== Magnific Popup js ======-->
<script src="{{ url('Front')}}/assets/js/jquery.magnific-popup.min.js"></script>

<!--====== Scrolling Nav js ======-->
<script src="{{ url('Front')}}/assets/js/jquery.easing.min.js"></script>
<script src="{{ url('Front')}}/assets/js/scrolling-nav.js"></script>

<!--====== wow js ======-->
<script src="{{ url('Front')}}/assets/js/wow.min.js"></script>

<!--====== Particles js ======-->
<script src="{{ url('Front')}}/assets/js/particles.min.js"></script>

<!--====== Main js ======-->
<script src="{{ url('Front')}}/assets/js/main.js"></script>

</body>

</html>
