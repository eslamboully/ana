@extends('Front.Layouts.master')

@section('content')
    <div class="section users-edit">
        <div class="card">
            <div class="card-content">
                <!-- <div class="card-body"> -->
                <ul class="tabs mb-2 row">
                    <li class="tab">
                        <a class="display-flex align-items-center active" id="account-tab" href="#account" style="display: flex">
                            <i class="material-icons mr-1">person_outline</i><span style="box-sizing: revert">@lang('front.account')</span>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="display-flex align-items-center" id="information-tab" href="#information" style="display: flex">
                            <i class="material-icons mr-2">error_outline</i><span style="box-sizing: revert">@lang('front.info')</span>
                        </a>
                    </li>
                </ul>
                <div class="divider mb-3"></div>
                <div class="row">
                    <div class="col s12" id="account">
                        <!-- users edit media object start -->
                        <div class="media display-flex align-items-center mb-2">
                            <a class="mr-2" href="#">
                                <img src="{{ url('uploads/users/'.auth()->user()->photo) }}" id="profile" alt="users avatar" class="z-depth-4 circle"
                                     height="64" width="64">
                            </a>
                            <div class="media-body">
                                <h5 class="media-heading mt-0">{{ auth()->user()->name }}</h5>
                                <div class="user-edit-btns display-flex">
                                    <a href="#" class="btn-small indigo" onclick="document.getElementById('profile-input').click()">@lang('front.change')</a>
{{--                                    <a href="#" class="btn-small btn-light-pink">Reset</a>--}}
                                </div>
                            </div>
                        </div>
                        <!-- users edit account form start -->
                        <form action="{{ route('profile.post') }}" method="post" enctype="multipart/form-data" id="accountForm">
                            @csrf
                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input type="file" class="hide" name="photo" id="profile-input" onchange="loadFile(event)">
                                            <input id="name" name="name" type="text" class="validate" value="{{ auth()->user()->name }}"
                                                   data-error=".errorTxt2">
                                            <label for="name">Name</label>
                                            <small class="errorTxt2"></small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="email" name="email" type="email" class="validate" value="{{ auth()->user()->email }}"
                                                   data-error=".errorTxt3">
                                            <label for="email">E-mail</label>
                                            <small class="errorTxt3"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input id="password" name="password" type="password" class="validate">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 display-flex justify-content-end mt-3">
                                    <button type="submit" class="btn indigo">
                                        Save changes</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit account form ends -->
                    </div>
                    <div class="col s12" id="information">
                        <!-- users edit Info form start -->
                        <form id="infotabForm">
                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12">
                                            <h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input class="validate" type="text" value="https://www.twitter.com/">
                                            <label>Twitter</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input class="validate" type="text" value="https://www.facebook.com/">
                                            <label>Facebook</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input class="validate" type="text">
                                            <label>Google+</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="linkedin" name="linkedin" class="validate" type="text">
                                            <label for="linkedin">LinkedIn</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input class="validate" type="text" value="https://www.instagram.com/">
                                            <label>Instagram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12">
                                            <h6 class="mb-4"><i class="material-icons mr-1">person_outline</i>Personal Info</h6>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="datepicker" name="datepicker" type="text" class="birthdate-picker datepicker"
                                                   placeholder="Pick a birthday" data-error=".errorTxt4">
                                            <label for="datepicker">Birth date</label>
                                            <small class="errorTxt4"></small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <select id="accountSelect">
                                                <option>USA</option>
                                                <option>India</option>
                                                <option>Canada</option>
                                            </select>
                                            <label>Country</label>
                                        </div>
                                        <div class="col s12">
                                            <label>Languages</label>
                                            <select class="browser-default" id="users-language-select2" multiple="multiple">
                                                <option value="English" selected>English</option>
                                                <option value="Spanish">Spanish</option>
                                                <option value="French">French</option>
                                                <option value="Russian">Russian</option>
                                                <option value="German">German</option>
                                                <option value="Arabic" selected>Arabic</option>
                                                <option value="Sanskrit">Sanskrit</option>
                                            </select>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="phonenumber" type="text" class="validate" value="(+656) 254 2568">
                                            <label for="phonenumber">Phone</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="address" name="address" type="text" class="validate" data-error=".errorTxt5">
                                            <label for="address">Address</label>
                                            <small class="errorTxt5"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="websitelink" name="websitelink" type="text" class="validate">
                                        <label for="websitelink">Website</label>
                                    </div>
                                    <label>Favourite Music</label>
                                    <div class="input-field">
                                        <select class="browser-default" id="users-music-select2" multiple="multiple">
                                            <option value="Rock">Rock</option>
                                            <option value="Jazz" selected>Jazz</option>
                                            <option value="Disco">Disco</option>
                                            <option value="Pop">Pop</option>
                                            <option value="Techno">Techno</option>
                                            <option value="Folk" selected>Folk</option>
                                            <option value="Hip hop">Hip hop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <label>Favourite movies</label>
                                    <div class="input-field">
                                        <select class="browser-default" id="users-movies-select2" multiple="multiple">
                                            <option value="The Dark Knight" selected>The Dark Knight
                                            </option>
                                            <option value="Harry Potter" selected>Harry Potter</option>
                                            <option value="Airplane!">Airplane!</option>
                                            <option value="Perl Harbour">Perl Harbour</option>
                                            <option value="Spider Man">Spider Man</option>
                                            <option value="Iron Man" selected>Iron Man</option>
                                            <option value="Avatar">Avatar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" class="btn indigo">
                                        Save changes</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit Info form ends -->
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
@endpush
