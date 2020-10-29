<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Kasasaa | Login</title>
    <link rel="apple-touch-icon" href="{{ url('Front') }}/app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('Front') }}/app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/themes/horizontal-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/themes/horizontal-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/layouts/style-horizontal.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/pages/login.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/custom/custom.css">

</head>
<!-- END: Head-->

<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">
<div class="row">
    <div class="col s12">
        <div class="container">
            <div id="login-page" class="row">
                <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                    <form class="login-form" action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <h5 class="ml-4">Sign in</h5>
                            </div>
                        </div>
                        @if(session()->has('message'))
                            <div class="row margin">
                                <p style="color: red">{{ session('message') }}</p>
                            </div>
                        @endif
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">person_outline</i>
                                <input id="username" name="email" type="text">
                                <label for="username" class="center-align">Username</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">lock_outline</i>
                                <input id="password" name="password" type="password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12 ml-2 mt-1">
                                <p>
                                    <label>
                                        <input type="checkbox" name="remember_me" />
                                        <span>Remember Me</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin medium-small"><a href="{{ route('register',['token' =>isset($_GET['token']) ? $_GET['token'] : 0 ,'board_id' => isset($_GET['board_id']) ? $_GET['board_id'] : 0 ]) }}">Register Now!</a></p>
                            </div>
                            <div class="input-field col s6 m6 l6">
                                <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
</div>

<!-- BEGIN VENDOR JS-->
<script src="{{ url('Front') }}/app-assets/js/vendors.min.js"></script>
<script src="{{ url('Front') }}/app-assets/js/plugins.js"></script>
<script src="{{ url('Front') }}/app-assets/js/search.js"></script>
<script src="{{ url('Front') }}/app-assets/js/custom/custom-script.js"></script>

</body>

</html>
