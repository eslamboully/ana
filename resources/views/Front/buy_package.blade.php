@extends('Front.Layouts.master')

@section('content')
    <div class="section users-edit">
        <div class="card">
            <div class="card-content">
                <!-- <div class="card-body"> -->
                <ul class="tabs mb-2 row">
                    <li class="tab">
                        <a class="display-flex align-items-center" id="subscription-tab" href="#subscription" style="display: flex">
                            <i class="material-icons mr-1">monetization_on</i><span style="box-sizing: revert">@lang('front.subscription')</span>
                        </a>
                    </li>
                </ul>
                <div class="divider mb-3"></div>
                <div class="row">
                    <div class="col s12" id="subscription">
                        <div>
                            <p>@lang('front.package_title') : {{ $package->title }}</p>
                            <p>@lang('front.price') : {{ $package->price }} $</p>
                            <p>@lang('front.days') : {{ $package->days }} @lang('front.day')</p>
                        </div>
                        <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
@endsection

@push('css')

@endpush

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
    <script>
        let loadFile = function(event) {
            let reader = new FileReader();
            reader.onload = function(){
                let output = document.getElementById('profile');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>

    <script src="https://www.paypal.com/sdk/js?client-id=sk_live_PAySYmxh6sLX8ctrEuDzfoib&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'pay',

                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"description":"{{ $package->title }}","amount":{"currency_code":"USD","value":'{{ $package->price }}'}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // alert('Transaction completed by ' + details.payer.name.given_name + '!');
                        $.ajax({
                            url: '{{ route('board.after.buy.package') }}',
                            method: 'post',
                            data: {_token: '{{ csrf_token() }}',package_id: '{{ $package->id }}'},
                            success: function (data) {
                                Swal.fire({
                                    title: 'Success',
                                    text: "Subscribe Successfully",
                                    icon: 'success',
                                    allowOutsideClick: false,
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Go To Work'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '{{ route('home') }}';
                                    }
                                })
                            }
                        });
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>
@endpush
