<aside id="right-sidebar-nav">
    <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
        <div class="row">
            <div class="slide-out-right-title">
                <div class="col s12 border-bottom-1 pb-0 pt-1">
                    <div class="row">
                        <div class="col s2 pr-0 center">
{{--                            <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>--}}
                        </div>
                        <div class="col s10 pl-0">
                            <ul class="tabs">
                                <li class="tab col s4 p-0">
                                    <a href="#messages" class="active">
                                        <span>@lang('front.messages')</span>
                                    </a>
                                </li>
                                <li class="tab col s4 p-0">
                                    <a href="#settings">
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li class="tab col s4 p-0">
                                    <a href="#activity">
                                        <span>Activity</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-out-right-body row pl-3">
                <div id="messages" class="col s12 pb-0">
                    <div class="collection border-none mb-0">
                        <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
                        <input type="hidden" name="message_board_id">
                        <ul class="collection right-sidebar-chat p-0 mb-0">
                            @foreach(auth()->user()->boards() as $board)
                            <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0 message_board_id" data-id="{{ $board->id }}" data-target="slide-out-chat">
                                <span class="avatar-status avatar-online avatar-50">
                                    <img src="{{ url('Front') }}/app-assets/images/avatar/avatar-7.png" alt="avatar" />
                                    <i></i>
                                </span>
                                <div class="user-content">
                                    <h6 class="line-height-0">{{ $board->name }}</h6>
                                    @if(count($board->messages) > 0)
                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">{{ $board->messages->first()->message }}</p>
                                    @endif
                                </div>
                                <span class="secondary-content medium-small">{{ $board->created_at->diffForHumans() }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="settings" class="col s12">
                    <p class="setting-header mt-8 mb-3 ml-5 font-weight-900">GENERAL SETTINGS</p>
                    <ul class="collection border-none">
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Notifications</span>
                                <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show recent activity</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show recent activity</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show Task statistics</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show your emails</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Email Notifications</span>
                                <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <p class="setting-header mt-7 mb-3 ml-5 font-weight-900">SYSTEM SETTINGS</p>
                    <ul class="collection border-none">
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>System Logs</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Error Reporting</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Applications Logs</span>
                                <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Backup Servers</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Audit Logs</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="activity" class="col s12">
                    <div class="activity">
                        <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
                        <ul class="widget-timeline mb-0">
                            <li class="timeline-items timeline-icon-green active">
                                <div class="timeline-time">Today</div>
                                <h6 class="timeline-title">Homepage mockup design</h6>
                                <p class="timeline-text">Melissa liked your activity.</p>
                                <div class="timeline-content orange-text">Important</div>
                            </li>
                            <li class="timeline-items timeline-icon-cyan active">
                                <div class="timeline-time">10 min</div>
                                <h6 class="timeline-title">Melissa liked your activity Drinks.</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content green-text">Resolved</div>
                            </li>
                            <li class="timeline-items timeline-icon-red active">
                                <div class="timeline-time">30 mins</div>
                                <h6 class="timeline-title">12 new users registered</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content">
                                    <img src="{{ url('Front') }}/app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Registration.doc
                                </div>
                            </li>
                            <li class="timeline-items timeline-icon-indigo active">
                                <div class="timeline-time">2 Hrs</div>
                                <h6 class="timeline-title">Tina is attending your activity</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content">
                                    <img src="{{ url('Front') }}/app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Activity.doc
                                </div>
                            </li>
                            <li class="timeline-items timeline-icon-orange">
                                <div class="timeline-time">5 hrs</div>
                                <h6 class="timeline-title">Josh is now following you</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content red-text">Pending</div>
                            </li>
                        </ul>
                        <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
                        <ul class="widget-timeline mb-0">
                            <li class="timeline-items timeline-icon-green active">
                                <div class="timeline-time">Just now</div>
                                <h6 class="timeline-title">New order received urgent</h6>
                                <p class="timeline-text">Melissa liked your activity.</p>
                                <div class="timeline-content orange-text">Important</div>
                            </li>
                            <li class="timeline-items timeline-icon-cyan active">
                                <div class="timeline-time">05 min</div>
                                <h6 class="timeline-title">System shutdown.</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content blue-text">Urgent</div>
                            </li>
                            <li class="timeline-items timeline-icon-red">
                                <div class="timeline-time">20 mins</div>
                                <h6 class="timeline-title">Database overloaded 89%</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content">
                                    <img src="{{ url('Front') }}/app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Database-log.doc
                                </div>
                            </li>
                        </ul>
                        <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
                        <ul class="widget-timeline mb-0">
                            <li class="timeline-items timeline-icon-green active">
                                <div class="timeline-time">10 min</div>
                                <h6 class="timeline-title">System error</h6>
                                <p class="timeline-text">Melissa liked your activity.</p>
                                <div class="timeline-content red-text">Error</div>
                            </li>
                            <li class="timeline-items timeline-icon-cyan">
                                <div class="timeline-time">1 min</div>
                                <h6 class="timeline-title">Production server down.</h6>
                                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                <div class="timeline-content blue-text">Urgent</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide Out Chat -->
    <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
        <li class="center-align pt-2 pb-2 sidenav-close chat-head">
            <a href="#!"><i class="material-icons mr-0">chevron_left</i><span class="conversion-title"></span></a>
        </li>
        <li class="chat-body">
            <ul class="collection chat-messages-div">
            </ul>
        </li>
        <li class="center-align chat-footer">
            <form class="col s12" onsubmit="sendChatMessage()" action="javascript:void(0);">
                <div class="input-field">
                    <input id="icon_prefix" type="text" class="search" autocomplete="off" />
                    <label for="icon_prefix">Type here..</label>
                    <a onclick="sendChatMessage()"><i class="material-icons prefix">send</i></a>
                </div>
            </form>
        </li>
    </ul>
</aside>
