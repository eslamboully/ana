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
                                <div class="col s12 input-field">
                                    <input id="datepicker" name="dateOfBirth" type="text" class="birthdate-picker datepicker"
                                           placeholder="@lang('front.dateOfBirth')" value="{{ auth()->user()->dateOfBirth }}" data-error=".errorTxt4">
                                    <label for="datepicker">@lang('front.dateOfBirth')</label>
                                    <small class="errorTxt4"></small>
                                </div>
                                @if(auth()->user()->country == "" or auth()->user()->country !== null)
                                    <div class="col s12 input-field">
                                        <input id="country" type="text" disabled class="validate" value="{{ auth()->user()->country }}">
                                        <label>@lang('front.country')</label>
                                    </div>
                                @else
                                    <div class="col s12 input-field">
                                        <select id="accountSelect" name="country">
                                            <option value="" selected="selected">Select Country</option>
                                            <option value="United States">United States</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="North Macedonia">North Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Yemen">Yemen</option>
                                        </select>
                                        <label>@lang('front.country')</label>
                                    </div>
                                @endif
                                <div class="col s12 input-field">
                                    <input id="phonenumber" type="text" name="phone" class="validate" value="{{ auth()->user()->phone }}">
                                    <label for="phonenumber">Phone</label>
                                </div>
                                <div class="col s12 input-field">
                                    <input id="address" name="address" type="text" value="{{ auth()->user()->address }}" class="validate" data-error=".errorTxt5">
                                    <label for="address">Address</label>
                                    <small class="errorTxt5"></small>
                                </div>

                                <div class="col s12 display-flex justify-content-end mt-3">
                                    <button type="submit" class="btn indigo">
                                        Save changes</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
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
