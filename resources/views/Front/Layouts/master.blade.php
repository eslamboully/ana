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
                    <li><a class="grey-text text-darken-1" href="user-login.html"><i class="material-icons">keyboard_tab</i> Logout</a></li>
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
                            <li data-menu=""><a href="../vertical-modern-menu-template/"><span data-i18n="Modern Menu">لوح اخري</span></a>
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
                </ul>
            </div>
            <!-- END: Horizontal nav start-->
        </nav>
    </div>
</header>
<!-- END: Header-->
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
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill red float-right mr-10">3</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="dashboard-modern.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Modern</span></a>
                    </li>
                    <li><a href="dashboard-ecommerce.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                    <li><a href="dashboard-analytics.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Analytics</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="Templates">Templates</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a class="collapsible-header waves-effect waves-cyan" href="Javascript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Vertical</span></a>
                        <div class="collapsible-body">
                            <ul class="collapsible" data-collapsible="accordion">
                                <li><a href="../vertical-modern-menu-template/"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern Menu">Modern Menu</span></a>
                                </li>
                                <li><a href="../vertical-menu-nav-dark-template/"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Navbar Dark">Navbar Dark</span></a>
                                </li>
                                <li><a href="../vertical-gradient-menu-template/"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Gradient Menu">Gradient Menu</span></a>
                                </li>
                                <li><a href="../vertical-dark-menu-template/"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Dark Menu">Dark Menu</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect waves-cyan" href="Javascript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Horizontal">Horizontal</span></a>
                        <div class="collapsible-body">
                            <ul class="collapsible" data-collapsible="accordion">
                                <li><a href="../horizontal-menu-template/"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Horizontal Menu">Horizontal Menu</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="app-email.html"><i class="material-icons">mail_outline</i><span class="menu-title" data-i18n="Mail">Mail</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="app-chat.html"><i class="material-icons">chat_bubble_outline</i><span class="menu-title" data-i18n="Chat">Chat</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="app-todo.html"><i class="material-icons">check</i><span class="menu-title" data-i18n="ToDo">ToDo</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="app-contacts.html"><i class="material-icons">import_contacts</i><span class="menu-title" data-i18n="Contacts">Contacts</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Calendar</span></a>
        </li>
        <li class="active bold"><a class="waves-effect waves-cyan active " href="app-kanban.html"><i class="material-icons">format_list_bulleted</i><span class="menu-title" data-i18n="Kanban">Kanban</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="app-file-manager.html"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="File Manager">File manager</span></a>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">receipt</i><span class="menu-title" data-i18n="Invoice">Invoice</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="app-invoice-list.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice List">Invoice List</span></a>
                    </li>
                    <li><a href="app-invoice-view.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice View">Invoice View</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Edit">Invoice Edit</span></a>
                    </li>
                    <li><a href="app-invoice-add.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Add">Invoice Add</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">add_shopping_cart</i><span class="menu-title" data-i18n="eCommerce">eCommerce</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="eCommerce-products-page.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Products Page">Products Page</span></a>
                    </li>
                    <li><a href="eCommerce-pricing.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Pricing">Pricing</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Pages </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="user-profile-page.html"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">User Profile</span></a>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Pages</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="page-contact.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Contact</span></a>
                    </li>
                    <li><a href="page-blog-list.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Blog">Blog</span></a>
                    </li>
                    <li><a href="page-search.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Search">Search</span></a>
                    </li>
                    <li><a href="page-knowledge.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Knowledge">Knowledge</span></a>
                    </li>
                    <li><a href="page-timeline.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Timeline">Timeline</span></a>
                    </li>
                    <li><a href="page-account-settings.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Account Settings">Account Settings</span></a>
                    </li>
                    <li><a href="page-faq.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="FAQs">FAQs</span></a>
                    </li>
                    <li><a href="page-blank.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Page Blank</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">crop_original</i><span class="menu-title" data-i18n="Medias">Medias</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="media-gallery-page.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Gallery Page">Gallery Page</span></a>
                    </li>
                    <li><a href="media-hover-effects.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Media Hover Effects">Media Hover Effects</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">User</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="page-users-list.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="List">List</span></a>
                    </li>
                    <li><a href="page-users-view.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="View">View</span></a>
                    </li>
                    <li><a href="page-users-edit.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Edit">Edit</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">lock_open</i><span class="menu-title" data-i18n="Authentication">Authentication</span><span class="badge badge pill purple float-right mr-10">10</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="user-login.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Login">Login</span></a>
                    </li>
                    <li><a href="user-register.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Register">Register</span></a>
                    </li>
                    <li><a href="user-forgot-password.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Forgot Password">Forgot Password</span></a>
                    </li>
                    <li><a href="user-lock-screen.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Lock Screen">Lock Screen</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">filter_tilt_shift</i><span class="menu-title" data-i18n="Misc">Misc</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="page-404.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="404">404</span></a>
                    </li>
                    <li><a href="page-maintenance.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Maintenanace">Page Maintenanace</span></a>
                    </li>
                    <li><a href="page-500.html" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="500">500</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">User Interface </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">cast</i><span class="menu-title" data-i18n="Cards">Cards</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="cards-basic.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Cards">Cards</span></a>
                    </li>
                    <li><a href="cards-advance.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Cards Advance">Cards Advance</span></a>
                    </li>
                    <li><a href="cards-extended.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Cards Extended">Cards Extended</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">invert_colors</i><span class="menu-title" data-i18n="CSS">CSS</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="css-typography.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Typograpy">Typograpy</span></a>
                    </li>
                    <li><a href="css-color.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Color</span></a>
                    </li>
                    <li><a href="css-grid.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Grid">Grid</span></a>
                    </li>
                    <li><a href="css-helpers.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Helpers">Helpers</span></a>
                    </li>
                    <li><a href="css-media.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Media">Media</span></a>
                    </li>
                    <li><a href="css-pulse.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Pulse">Pulse</span></a>
                    </li>
                    <li><a href="css-sass.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Sass">Sass</span></a>
                    </li>
                    <li><a href="css-shadow.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Shadow">Shadow</span></a>
                    </li>
                    <li><a href="css-animations.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Animations">Animations</span></a>
                    </li>
                    <li><a href="css-transitions.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Transitions">Transitions</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">photo_filter</i><span class="menu-title" data-i18n="Basic UI">Basic UI</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a class="collapsible-header waves-effect waves-cyan" href="Javascript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Buttons">Buttons</span></a>
                        <div class="collapsible-body">
                            <ul class="collapsible" data-collapsible="accordion">
                                <li><a href="ui-basic-buttons.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a href="ui-extended-buttons.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Extended">Extended</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="ui-icons.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Icons">Icons</span></a>
                    </li>
                    <li><a href="ui-alerts.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Alerts">Alerts</span></a>
                    </li>
                    <li><a href="ui-badges.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Badges">Badges</span></a>
                    </li>
                    <li><a href="ui-breadcrumbs.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                    </li>
                    <li><a href="ui-chips.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Chips">Chips</span></a>
                    </li>
                    <li><a href="ui-collections.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Collections">Collections</span></a>
                    </li>
                    <li><a href="ui-navbar.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Navbar">Navbar</span></a>
                    </li>
                    <li><a href="ui-pagination.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Pagination">Pagination</span></a>
                    </li>
                    <li><a href="ui-preloader.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Preloader">Preloader</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">settings_brightness</i><span class="menu-title" data-i18n="Advanced UI">Advanced UI</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="advance-ui-carousel.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Carousel">Carousel</span></a>
                    </li>
                    <li><a href="advance-ui-collapsibles.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Collapsibles">Collapsibles</span></a>
                    </li>
                    <li><a href="advance-ui-toasts.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Toasts">Toasts</span></a>
                    </li>
                    <li><a href="advance-ui-tooltip.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Tooltip">Tooltip</span></a>
                    </li>
                    <li><a href="advance-ui-dropdown.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Dropdown">Dropdown</span></a>
                    </li>
                    <li><a href="advance-ui-feature-discovery.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Discovery">Discovery</span></a>
                    </li>
                    <li><a href="advance-ui-media.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Media">Media</span></a>
                    </li>
                    <li><a href="advance-ui-modals.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modals">Modals</span></a>
                    </li>
                    <li><a href="advance-ui-scrollspy.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Scrollspy">Scrollspy</span></a>
                    </li>
                    <li><a href="advance-ui-tabs.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Tabs">Tabs</span></a>
                    </li>
                    <li><a href="advance-ui-waves.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Waves">Waves</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">add_to_queue</i><span class="menu-title" data-i18n="Extra Components">Extra Components</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="extra-components-range-slider.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Range Slider">Range Slider</span></a>
                    </li>
                    <li><a href="extra-components-sweetalert.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Sweetalert">Sweetalert</span></a>
                    </li>
                    <li><a href="extra-components-nestable.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Nestable">Nestable</span></a>
                    </li>
                    <li><a href="extra-components-treeview.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Treeview">Treeview</span></a>
                    </li>
                    <li><a href="extra-components-ratings.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Ratings">Ratings</span></a>
                    </li>
                    <li><a href="extra-components-tour.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Tour">Tour</span></a>
                    </li>
                    <li><a href="extra-components-i18n.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="i18n">i18n</span></a>
                    </li>
                    <li><a href="extra-components-highlight.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Highlight">Highlight</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Tables &amp; Forms </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="table-basic.html"><i class="material-icons">border_all</i><span class="menu-title" data-i18n="Basic Tables">Basic Tables</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="table-data-table.html"><i class="material-icons">border_all</i><span class="menu-title" data-i18n="Data Tables">Data Tables</span></a>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">chrome_reader_mode</i><span class="menu-title" data-i18n="Form Elements">Form Elements</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="form-elements.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Form Elements">Form Elements</span></a>
                    </li>
                    <li><a href="form-select2.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Form Select2">Form Select2</span></a>
                    </li>
                    <li><a href="form-validation.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Form Validation">Form Validation</span></a>
                    </li>
                    <li><a href="form-masks.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Form Masks">Form Masks</span></a>
                    </li>
                    <li><a href="form-editor.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Form Editor">Form Editor</span></a>
                    </li>
                    <li><a href="form-file-uploads.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="File Uploads">File Uploads</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="form-layouts.html"><i class="material-icons">image_aspect_ratio</i><span class="menu-title" data-i18n="Form Layouts">Form Layouts</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="form-wizard.html"><i class="material-icons">settings_ethernet</i><span class="menu-title" data-i18n="Form Wizard">Form Wizard</span></a>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Charts</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">pie_chart_outlined</i><span class="menu-title" data-i18n="Chart">Chart</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="charts-chartjs.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="ChartJS">ChartJS</span></a>
                    </li>
                    <li><a href="charts-chartist.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Chartist">Chartist</span></a>
                    </li>
                    <li><a href="charts-sparklines.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Sparkline Charts">Sparkline Charts</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Misc </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">photo_filter</i><span class="menu-title" data-i18n="Menu levels">Menu levels</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="Javascript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Second level">Second level</span></a>
                    </li>
                    <li><a class="collapsible-header waves-effect waves-cyan" href="Javascript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Second level">Second level child</span></a>
                        <div class="collapsible-body">
                            <ul class="collapsible" data-collapsible="accordion">
                                <li><a href="Javascript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Third level">Third level</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="../https://pixinvent.com/materialize-material-design-admin-template/documentation/index.html" target="_blank"><i class="material-icons">import_contacts</i><span class="menu-title" data-i18n="Documentation">Documentation</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="https://pixinvent.ticksy.com/" target="_blank"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="Support">Support</span></a>
        </li>
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
                    <div class="kanban-overlay"></div>
                    <div class="row">
                        <div class="col s12">
                            <!-- New kanban board add button -->
                            <button type="button" style="font-family: 'Cairo', sans-serif !important;background-color: #ffc107" class="btn waves-effect waves-light mb-1 add-kanban-btn" id="add-kanban">
                                <i class='material-icons left'>add</i> @lang('front.add_new_board')
                            </button>
                            <!-- kanban container -->
                            @yield('content')
                        </div>
                    </div>

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

<!-- BEGIN: Footer-->

<footer class="page-footer footer footer-static footer-dark gradient-shadow navbar-border navbar-shadow" style="background-color: #ffc107 !important;">
    <div class="footer-copyright">
        <div class="container"><span>&copy; 2020 <a href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="https://pixinvent.com/">PIXINVENT</a></span></div>
    </div>
</footer>

<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="{{ url('Front') }}/app-assets/js/vendors.min.js"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ url('Front') }}/app-assets/vendors/jkanban/jkanban.min.js"></script>
<script src="{{ url('Front') }}/app-assets/vendors/quill/quill.min.js"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ url('Front') }}/app-assets/js/plugins.js"></script>
<script src="{{ url('Front') }}/app-assets/js/search.js"></script>
<!-- END THEME  JS-->
@stack('js')

</body>

</html>
