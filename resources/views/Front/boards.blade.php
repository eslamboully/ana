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
                                @foreach(auth()->user()->boards() as $board)
                                <div class="col s12 m6 l3 card-width">
                                    <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-5">
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

@push('js')

@endpush
