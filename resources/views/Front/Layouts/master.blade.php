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
                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img style="height: 28px;width: 28px;" src="{{ url('uploads/users/'.auth()->user()->photo) }}" alt="avatar"><i></i></span></a></li>
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
                    <li><a class="grey-text text-darken-1" href="{{ route('profile') }}"><i class="material-icons">person_outline</i> @lang('front.profile')</a></li>
{{--                    <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>--}}
{{--                    <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>--}}
{{--                    <li class="divider"></li>--}}
{{--                    <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>--}}
                    <li><a class="grey-text text-darken-1" href="{{ route('logout') }}"><i class="material-icons">keyboard_tab</i> @lang('front.logout')</a></li>
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
                        <a class="waves-effect waves-light modal-trigger" href="{{ route('home') }}">
                            <i class="material-icons">dashboard</i>
                            <span>
                                <span class="dropdown-title" data-i18n="Apps">
                                    @lang('front.my')
                                </span>
                            </span>
                        </a>
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
            <input style="width: 40%" type="text" name="name" required class="form-control" placeholder="@lang('front.project_name')">
            <input style="width: 20%" type="text" name="startDate" required class="form-control datepicker" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" placeholder="@lang('front.startdate')">
            <input style="width: 20%" type="text" name="endDate" required class="form-control datepicker" value="{{ \Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}" placeholder="@lang('front.endDate')">
        </div>
        <div class="modal-footer">
            <button type="submit" style="float: right" class="modal-action modal-close waves-effect waves-green btn-flat">@lang('front.agree')</button>
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
@stack('main-board-settings')
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

@stack('modals')
<!-- BEGIN: Footer-->

<footer class="page-footer footer footer-static footer-dark gradient-shadow navbar-border navbar-shadow" style="background-color: #ffc107 !important;">
    <div class="footer-copyright">
        <div class="container"><span>@lang('front.first_reserved_footer')</span><span class="right hide-on-small-only">@lang('front.last_reserved_footer')</span></div>
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

        Swal.showLoading();
        $.ajax({
            method: "post",
            url: "{{ route('board.send_invitation') }}",
            data : {id:id,email:email,_token: '{{ csrf_token() }}'},
            success : (data) => {
                $("input[name=email]").val('');
                Swal.hideLoading();
                Swal.clickConfirm();
                Swal.fire(
                    "{{ __('front.good_job') }}",
                    "{{ __('front.success_invitation') }}",
                    "success"
                );
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
                                        <input type="hidden" name="usersIds[]" value="${user.id}">
                                        <input type="radio" class="filled-in" name="permission-user-${user.id}" value="${"manager-board-"+id}" ${user.roles.some(e => e.name === "manager-board-"+id) ? 'checked' : ''} />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td>
                                <p class="mb-1">
                                    <label>
                                        <input type="radio" class="filled-in" name="permission-user-${user.id}" value="${"monitor-board-"+id}" ${user.roles.some(e => e.name === "monitor-board-"+id) ? 'checked' : ''} />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td>
                                <p class="mb-1">
                                    <label>
                                        <input type="radio" class="filled-in" name="permission-user-${user.id}" value="${"employee-board-"+id}" ${user.roles.some(e => e.name === "employee-board-"+id) ? 'checked' : ''} />
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

<script>
    function sendChatMessage() {
        var message = $(".search").val();
        if (message != "") {
            var html =
                '<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat"><div class="user-content speech-bubble-right">' +
                '<p class="medium-small">' +
                message +
                "</p>" +
                "</div></li>";
            $("#right-sidebar-nav #slide-out-chat .chat-body .collection").append(html);
            $(".search").val("");
            var charScroll = $("#right-sidebar-nav #slide-out-chat .chat-body .collection");
            if (charScroll.length > 0) {
                charScroll[0].scrollTop = charScroll[0].scrollHeight;
            }

            let board_id = $('input[name=board_id]').val();

            $.ajax({
                'url' : "{{ route('board.message.send') }}",
                'method' : "post",
                'data' : {message: message,board_id : board_id,user_id: '{{ auth()->user()->id }}',_token: '{{ csrf_token() }}'},
                success : function () {

                },
                fail : () => {
                    alert('something is wrong');
                }
            });
        }
    }

    $(document).on('click','.message_board_id',function (){
        $('input[name=board_id]').val($(this).data('id'));

        let board_id = $('input[name=board_id]').val();

        $.ajax({
            method: 'post',
            url: '{{ route('board.response.messages') }}',
            data: {board_id,_token:'{{ csrf_token() }}'},
            success : function (data) {
                $('.conversion-title').html(data.board.name);
                $('.chat-messages-div').html("");
                data.data.forEach(function(message){
                    if (message.user_id == '{{ auth()->user()->id }}') {
                        $('.chat-messages-div').append(`
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                                <div class="user-content speech-bubble-right">
                                    <p class="medium-small">${message.message}</p>
                                </div>
                            </li>
                        `);
                    } else {
                        $('.chat-messages-div').append(`
                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img src="${ '{{ url("Front") }}' }/app-assets/images/avatar/avatar-7.png" alt="avatar" />
                                                    </span>
                                <div class="user-content speech-bubble">
                                    <p class="medium-small">${message.message}</p>
                                </div>
                            </li>
                        `);
                    }

                });
            }
        });

    });
</script>

{{-- Pusher RealTime --}}
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    let pusher = new Pusher('c94ca2fab6f7c2428792', {
        cluster: 'eu'
    });

    let channel = pusher.subscribe('send-message-channel');
    channel.bind('send-message-event', function(data) {
        if (data.message.user_id != '{{ auth()->user()->id }}') {
            $('.chat-messages-div').append(`
                <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img src="${ '{{ url("Front") }}' }/app-assets/images/avatar/avatar-7.png" alt="avatar" />
                                        </span>
                    <div class="user-content speech-bubble">
                        <p class="medium-small">${data.message.message}</p>
                    </div>
                </li>
            `);

            let charScroll = $("#right-sidebar-nav #slide-out-chat .chat-body .collection");
            if (charScroll.length > 0) {
                charScroll[0].scrollTop = charScroll[0].scrollHeight;
            }
        }
    });
</script>

<script>

</script>
</body>

</html>
