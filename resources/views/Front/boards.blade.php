@extends('Front.Layouts.master')

@section('content')
    <div class="row">
        <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>@lang('front.all_boards')</span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="#">@lang('front.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('front.all_boards')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!--Gradient Card-->
                <div id="cards-extended">
                    <div class="card">
                        <div class="card-content">
{{--                            <h4 class="card-title">Gradient Card &amp; Gradient Card With Analytics</h4>--}}
{{--                            <p>--}}
{{--                                Here is the gradient card with flat image for all gradient classes please check--}}
{{--                                <a href="css-color.html" target="_blank"> css-color.html</a>.--}}
{{--                            </p>--}}
                            <div class="row" id="gradient-Analytics">
                                    <div class="col s12 m6 l3 card-width">
                                        <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-5">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5 mb-5">attach_money</i>
                                                <p>
                                                    <a href="{{ route('home') }}" style="color: white">{{ auth()->user()->personal_board()->name }}</a>
                                                </p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 class="mb-0 white-text"></h5>
                                                <p class="no-margin">{{ auth()->user()->personal_board()->user->name }}</p>
                                                <p>{{ count(auth()->user()->personal_board()->smallBoards) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @php $colors = [
                                        'gradient-45deg-blue-indigo',
                                        'gradient-45deg-purple-deep-orange',
                                        'gradient-45deg-purple-deep-purple'
                                        ];
                                    $colorsRand = array_rand($colors,1);
                                @endphp
                                @foreach(auth()->user()->boards() as $board)
                                    <div class="col s12 m6 l3 card-width">
                                        <div class="card row {{ $colors[$colorsRand] }} gradient-shadow white-text padding-4 mt-5">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5 mb-5">attach_money</i>
                                                <p>
                                                    <a href="{{ route('board.index',['id' => $board->id,'name' => str_replace(' ','-',$board->name)]) }}" style="color: white">{{ $board->name }}</a>
                                                </p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 class="mb-0 white-text"></h5>
                                                <p class="no-margin">{{ $board->user->name }}</p>
                                                <p>{{ count($board->smallBoards) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="divider mt-2"></div>
                    <!--Gradient Chart Card-->

                </div><!-- START RIGHT SIDEBAR NAV -->
                <!-- END RIGHT SIDEBAR NAV -->
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

@push('main-board-settings')
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
                                                    <small>@lang('front.assign_to')</small>
                                                    <div class="display-flex">
                                                        <div class="avatar ">
                                                            <img src="{{ url('Front') }}/app-assets/images/avatar/avatar-18.png" class="circle aside-user-photo" height="36" width="36" alt="avtar img holder">
                                                        </div>
                                                        <a href="#modal4" class="btn-floating btn-small pulse ml-10 btn modal-trigger assign-quest-user">
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
                                        @if(
                                        auth()->user()->hasRole('manager-board-'.request()->route()->parameter('id'))
                                        || auth()->user()->hasRole('monitor-board-'.request()->route()->parameter('id'))
                                        )
                                            <button type="reset" class="btn-small waves-effect waves-light delete-kanban-item mr-1">
                                                <span>@lang('front.delete')</span>
                                            </button>
                                        @else
                                            <a href="#modal4" class="btn-small btn waves-light modal-trigger mr-1">
                                                <span>@lang('front.delete')</span>
                                            </a>
                                        @endif
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
@endpush

@push('js')

@endpush
