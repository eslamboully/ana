<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>App Kanban | Materialize - Material Design Admin Template</title>
    <link rel="apple-touch-icon" href="{{ url('Front') }}/app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('Front') }}/app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/vendors/vendors.min.css">
    <link rel="stylesheet" href="{{ url('Front') }}/app-assets/vendors/select2/select2.min.css" type="text/css">
    <link rel="stylesheet" href="{{ url('Front') }}/app-assets/vendors/select2/select2-materialize.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/vendors/jkanban/jkanban.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/vendors/quill/quill.snow.css">
    <!-- END: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}/style{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}.css">
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}/themes/horizontal-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}/themes/horizontal-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}/layouts/style-horizontal.css">
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css/pages/app-kanban.css">
    <!-- END: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}/custom/custom.css">

    <link rel="stylesheet" type="text/css" href="{{ url('Front') }}/app-assets/css{{ App()->getLocale() == 'ar' ? '-rtl' : '' }}/pages/form-select2.css">

    @if(App()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6, a, li, label, input, span, button th, td, p ,tr{
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @endif

    @stack('css')
</head>
<!-- END: Head-->

<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 2-columns  app-page menu-collapse" data-open="click" data-menu="horizontal-menu" data-col="2-columns">

<!-- BEGIN: Header-->
<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-light-orange-cyan" style="background-color: #FFC107">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img src="{{ url('Front') }}/app-assets/images/logo/materialize-logo.png" alt="materialize logo"><span class="logo-text hide-on-med-and-down">@lang('front.site_name')</span></a></h1>
                    </li>
                </ul>
                <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons" style="font-family: 'Cairo', sans-serif !important;"> @lang('front.search')</i>
                    <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="@lang('front.search_desc')" data-search="template-list">
                    <ul class="search-list collection display-none"></ul>
                </div>
                <ul class="navbar-list right">
                    <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button" href="javascript:void(0);" data-target="translation-dropdown"><span class="flag-icon flag-icon-gb"></span></a></li>
                    <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search </i></a></li>
                    <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge orange accent-3">5</small></i></a></li>
                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{ url('Front') }}/app-assets/images/avatar/avatar-18.png" alt="avatar"><i></i></span></a></li>
                    <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li>
                </ul>
                <!-- translation-button-->
                <ul class="dropdown-content" id="translation-dropdown">
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ route('lang','en') }}" data-language="en"><i class="flag-icon flag-icon-gb"></i> @lang('front.english')</a></li>
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ route('lang','ar') }}" data-language="ar"><i class="flag-icon flag-icon-au"></i> @lang('front.arabic')</a></li>
                </ul>
                <!-- notifications-dropdown-->
                <ul class="dropdown-content" id="notifications-dropdown">
                    <li>
                        <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
                    </li>
                    <li class="divider"></li>
                    <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                    </li>
                </ul>
                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
                    <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
                    <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>
                    <li class="divider"></li>
                    <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>
                    <li><a class="grey-text text-darken-1" href="{{ route('logout') }}"><i class="material-icons">keyboard_tab</i> Logout</a></li>
                </ul>
            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form id="navbarForm">
                        <div class="input-field search-input-sm">
                            <input class="search-box-sm" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                            <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                            <ul class="search-list collection search-list-sm display-none"></ul>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
        <!-- BEGIN: Horizontal nav start-->
        <nav class="white hide-on-med-and-down" id="horizontal-nav">
            <div class="nav-wrapper">
                <ul class="left hide-on-med-and-down" id="ul-horizontal-nav" data-menu="menu-navigation">
                    <li>
                        <a class="dropdown-menu" href="Javascript:void(0)" data-target="DashboardDropdown">
                            <i class="material-icons">dashboard</i>
                            <span>
                                <span class="dropdown-title" data-i18n="Dashboard">
                                    @lang('front.dashboard')
                                </span>
                                <i class="material-icons right">keyboard_arrow_down</i>
                            </span>
                        </a>
                        <ul class="dropdown-content dropdown-horizontal-list" id="DashboardDropdown">
                            <li data-menu=""><a href="{{ route('home') }}"><span data-i18n="Modern">@lang('front.my')</span></a>
                            </li>
                            <li data-menu=""><a href="#"><span data-i18n="eCommerce">@lang('front.latest_ques')</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-menu" href="Javascript:void(0)" data-target="TemplatesDropdown">
                            <i class="material-icons">dvr</i>
                            <span>
                                <span class="dropdown-title" data-i18n="Templates">
                                    @lang('front.permissions')
                                </span>
                                <i class="material-icons right">keyboard_arrow_down</i>
                            </span>
                        </a>
                        <ul class="dropdown-content dropdown-horizontal-list" id="TemplatesDropdown">
                            <li data-menu=""><a href="{{ route('board.boards.all') }}"><span data-i18n="Modern Menu">@lang('front.all_boards')</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="dropdown-menu" href="Javascript:void(0)" data-target="AppsDropdown"><i class="material-icons">mail_outline</i><span><span class="dropdown-title" data-i18n="Apps">@lang('front.settings')</span><i class="material-icons right">keyboard_arrow_down</i></span></a>
                        <ul class="dropdown-content dropdown-horizontal-list" id="AppsDropdown">
                            <li data-menu=""><a href="app-email.html"><span data-i18n="Mail">@lang('front.settings')</span></a>
                            </li>
                            <li data-menu=""><a href="app-email.html"><span data-i18n="Mail">@lang('front.others')</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect waves-light modal-trigger" href="#modal1">
                            <i class="material-icons">add_shopping_cart</i>
                            <span>
                                <span class="dropdown-title" data-i18n="Apps">
                                    @lang('front.add_new_work')
                                </span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END: Horizontal nav start-->
        </nav>
    </div>
</header>
<!-- END: Header-->

<!-- Modal Structure -->
<div id="modal1" class="modal bottom-sheet">
    <form action="{{ route('board.store') }}" method="post">
        @csrf
        <div class="modal-content">
            <h4>@lang('front.name_of_board')</h4>
            <input type="text" name="name" required class="form-control" placeholder="@lang('front.project_name')">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">@lang('front.agree')</button>
        </div>
    </form>
</div>

<!-- Modal Structure -->
<div id="modal2" class="modal ">
    <form action="{{ route('board.send_invitation') }}" method="post">
        @csrf
        <div class="modal-content">
            <h4>@lang('front.users')</h4>
            <div class="input-field">
                <input type="hidden" name="id" value="{{ request()->route()->parameter('id') }}">
                <input type="text" name="email" class="form-control" value="" placeholder="@lang('front.user_email')">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="modal-send-invitation" class="modal-action modal-close waves-effect waves-green btn-flat">@lang('front.agree')</button>
        </div>
    </form>
</div>

<ul class="display-none" id="default-search-main">
    <li class="auto-suggestion-title"><a class="collection-item" href="#">
            <h6 class="search-title">FILES</h6>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ url('Front') }}/app-assets/images/icon/pdf-image.png" width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Two new item submitted</span><small class="grey-text">Marketing Manager</small></div>
                </div>
                <div class="status"><small class="grey-text">17kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ url('Front') }}/app-assets/images/icon/doc-image.png" width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file Generator</span><small class="grey-text">FontEnd Developer</small></div>
                </div>
                <div class="status"><small class="grey-text">550kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ url('Front') }}/app-assets/images/icon/xls-image.png" width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                </div>
                <div class="status"><small class="grey-text">20kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ url('Front') }}/app-assets/images/icon/jpg-image.png" width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                </div>
                <div class="status"><small class="grey-text">37kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion-title"><a class="collection-item" href="#">
            <h6 class="search-title">MEMBERS</h6>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle" src="{{ url('Front') }}/app-assets/images/avatar/avatar-7.png" width="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">John Doe</span><small class="grey-text">UI designer</small></div>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle" src="{{ url('Front') }}/app-assets/images/avatar/avatar-8.png" width="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Michal Clark</span><small class="grey-text">FontEnd Developer</small></div>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle" src="{{ url('Front') }}/app-assets/images/avatar/avatar-10.png" width="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Milena Gibson</span><small class="grey-text">Digital Marketing</small></div>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle" src="{{ url('Front') }}/app-assets/images/avatar/avatar-12.png" width="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                </div>
            </div>
        </a></li>
</ul>
<ul class="display-none" id="page-search-title">
    <li class="auto-suggestion-title"><a class="collection-item" href="#">
            <h6 class="search-title">PAGES</h6>
        </a></li>
</ul>
<ul class="display-none" id="search-not-found">
    <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span class="material-icons">error_outline</span><span class="member-info">No results found.</span></a></li>
</ul>



<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-fixed hide-on-large-only">
    <div class="brand-sidebar sidenav-light"></div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed hide-on-large-only menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->

<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="content-wrapper-before blue-grey lighten-5"></div>
        <div class="col s12">
            <div class="container">
                <!-- Basic Kanban App -->
                <section id="kanban-wrapper" class="section">

                            @yield('content')


                    <!-- User new mail right area -->
                    <div class="kanban-sidebar">
                        <div class="card quill-wrapper">
                            <div class="card-content pt-0">
                                <div class="card-header display-flex pb-2">
                                    <h3 class="card-title">@lang('front.ques_detail')</h3>
                                    <div class="close close-icon">
                                        <i class="material-icons">close</i>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <!-- form start -->
                                <form class="edit-kanban-item mt-10 mb-10">
                                    <div class="input-field">
                                        <input type="hidden" class="item-id">
                                        <input type="text" class="edit-kanban-item-title validate" id="edit-item-title" placeholder="kanban Title">
                                        <label for="edit-item-title">@lang('front.title')</label>
                                    </div>
                                    <div class="input-field">
                                        <input type="text" class="edit-kanban-item-date datepicker" id="edit-item-date" value="21/08/2019">
                                        <label for="edit-item-date">@lang('front.duedate')</label>
                                    </div>
                                    <div class="row">
                                        <div class="col s6">
                                            <div class="input-field mt-0">
                                                <small>@lang('front.label_color')</small>
                                                <select id="kanban-item-color" name="color" class="browser-default">
                                                    <option class="blue" value="blue">Blue</option>
                                                    <option class="red" value="red">Red</option>
                                                    <option class="green" value="green">Green</option>
                                                    <option class="cyan" value="cyan">Cyan</option>
                                                    <option class="orange" value="orange">Orange </option>
                                                    <option class="blue-grey" value="blue-grey">Blue-grey</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="input-field mt-0">
                                                <small>@lang('front.members')</small>
                                                <div class="display-flex">
                                                    <div class="avatar ">
                                                        <img src="{{ url('Front') }}/app-assets/images/avatar/avatar-18.png" class="circle" height="36" width="36" alt="avtar img holder">
                                                    </div>
                                                    <a class="btn-floating btn-small pulse ml-10">
                                                        <i class="material-icons">add</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="file-field input-field">
                                        <div class="btn btn-file">
                                            <span>@lang('front.upload_file')</span>
                                            <input type="file" name="attachment_file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>

                                    <div class="file-field input-field">
                                        <div class="file-path-wrapper spectacular_files" style="width: 100%;">

                                        </div>
                                    </div>
                                    <!-- Compose mail Quill editor -->
                                    <div class="input-field">
                                        <span>@lang('front.comments')</span>
                                        <div class="snow-container mt-2">
                                            <div class="compose-editor"></div>
                                            <div class="compose-quill-toolbar">
{{--                                                    <span class="ql-formats mr-0">--}}
{{--                                                        <button class="ql-bold"></button>--}}
{{--                                                        <button class="ql-italic"></button>--}}
{{--                                                        <button class="ql-underline"></button>--}}
{{--                                                        <button class="ql-link"></button>--}}
{{--                                                        <button class="btn btn-small cyan btn-comment waves-effect waves-light ml-25">Comment</button>--}}
{{--                                                    </span>--}}
                                            </div>
                                        </div>
                                        <div class="snow-container mt-1">
                                            <div class="compose-editor comments_paragraph"></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-action pl-0 pr-0">
                                    <button class="btn-small blue waves-effect waves-light update-kanban-item">
                                        <span>@lang('front.save')</span>
                                    </button>
                                    <button type="reset" class="btn-small waves-effect waves-light delete-kanban-item mr-1">
                                        <span>@lang('front.delete')</span>
                                    </button>
                                </div>
                                <!-- form start end-->
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Sample Project kanban -->
                @include('Front.Layouts.aside')
                <!-- END RIGHT SIDEBAR NAV -->
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->
<!-- Modal Structure -->
<div id="modal3" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>@lang('front.users')</h4>
        <a class="waves-effect waves-light btn modal-trigger" href="#modal2">@lang('front.add_users')</a>
        <form class="form-permissions-update" action="{{ route('board.users.permissions.update') }}" method="post">
            @csrf
            <input type="hidden" name="board_id" value="{{ request()->route()->parameter('id') }}">
            <table class="table">
                <tr>
                    <td>@lang('front.users')</td>
                    <td>@lang('front.manager')</td>
                    <td>@lang('front.monitor')</td>
                    <td>@lang('front.employee')</td>
                </tr>
                    @csrf
                    <tbody class="users-permissions-list">

                    </tbody>
            </table>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat users-permissions-reload">@lang('front.apply')</a>
    </div>
</div>

<!-- BEGIN: Footer-->

<footer class="page-footer footer footer-static footer-dark gradient-shadow navbar-border navbar-shadow" style="background-color: #ffc107 !important;">
    <div class="footer-copyright">
        <div class="container"><span>&copy; 2020 <a href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="https://pixinvent.com/">PIXINVENT</a></span></div>
    </div>
</footer>

<!-- BEGIN VENDOR JS-->
<script src="{{ url('Front') }}/app-assets/js/vendors.min.js"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ url('Front') }}/app-assets/vendors/jkanban/jkanban.min.js"></script>
<script src="{{ url('Front') }}/app-assets/vendors/quill/quill.min.js"></script>
<!-- END PAGE VENDOR JS-->
<script src="{{ url('Front') }}/app-assets/vendors/select2/select2.full.min.js"></script>
<script src="{{ url('Front') }}/app-assets/vendors/noUiSlider/nouislider.js"></script>

<script src="{{ url('Front') }}/app-assets/js/plugins.js"></script>
<script src="{{ url('Front') }}/app-assets/js/search.js"></script>
{{--<script src="{{ url('Front') }}/app-assets/js/custom/custom-script.js"></script>--}}
<script src="{{ url('Front') }}/app-assets/js/scripts/advance-ui-modals.js"></script>
<script src="{{ url('Front') }}/app-assets/js/scripts/form-select2.js"></script>
{{--<script src="{{ url('Front') }}//app-assets/js/scripts/form-elements.js"></script>--}}
<!-- END THEME  JS-->
@stack('js')

<script>
    // Basic Select2 select
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    $('#modal-send-invitation').on('click', function (e) {
        e.preventDefault();
        let id    = $("input[name=id]").val();
        let email = $("input[name=email]").val();

        $.ajax({
            method: "post",
            url: "{{ route('board.send_invitation') }}",
            data : {id:id,email:email,_token: '{{ csrf_token() }}'},
            success : (data) => {
                $("input[name=email]").val('');
                alert('sent successfully');
            }
        });
    });

    $('.users-permissions-button').on('click', function (e) {
        e.preventDefault();
        let id = '{{ request()->route()->parameter('id') }}';
        $.ajax({
            method: "post",
            url: "{{ route('board.users.permissions.get') }}",
            data : {id:id,_token: '{{ csrf_token() }}'},
            success : (data) => {
                $('.users-permissions-list').html('');

                data.data.forEach((user,index) => {
                    $('.users-permissions-list').append(`
                        <tr>
                            <td>${user.email}</td>
                            <td>
                                <p class="mb-1">
                                    <label>
                                        <input type="checkbox" class="filled-in" name="users[${user.id}][${"manager-board-"+id}]" ${user.roles.some(e => e.name === "manager-board-"+id) ? 'checked' : ''} />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td>
                                <p class="mb-1">
                                    <label>
                                        <input type="checkbox" class="filled-in" name="users[${user.id}][${"monitor-board-"+id}]" ${user.roles.some(e => e.name === "monitor-board-"+id) ? 'checked' : ''} />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td>
                                <p class="mb-1">
                                    <label>
                                        <input type="checkbox" class="filled-in" name="users[${user.id}][${"employee-board-"+id}]" ${user.roles.some(e => e.name === "employee-board-"+id) ? 'checked' : ''} />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });
    $('.users-permissions-reload').on('click',function(e) {
        e.preventDefault();
        let form = $('.form-permissions-update').serialize();
        $.ajax({
            method: 'post',
            url: '{{ route('board.users.permissions.update') }}',
            data: form,
        });
    });
</script>

</body>

</html>
