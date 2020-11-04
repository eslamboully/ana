@extends('Front.Layouts.master')

@section('content')
    <div class="kanban-overlay"></div>
    <div class="row">
        <div class="pt-1 pb-0" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h6 class="breadcrumbs-title"><span>{{ $myBoard->name }}</span></h6>
                        <p style="font-size: 12px;">@lang('front.start_from'): {{ $myBoard->startDate }}  @lang('front.end_to'): {{ $myBoard->endDate }}</p>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
{{--                        <ol class="breadcrumbs mb-0">--}}
{{--                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('front.my')</a>--}}
{{--                            </li>--}}
{{--                            <li class="breadcrumb-item"><a href="{{ route('board.boards.all') }}">@lang('front.all_boards')</a>--}}
{{--                            </li>--}}
{{--                            <li class="breadcrumb-item active">{{ $myBoard->name }}--}}
{{--                            </li>--}}
{{--                        </ol>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12" style="margin-top: -50px">
            <!-- New kanban board add button -->
            @if(auth()->user()->hasRole("manager-board-".request()->route()->parameter('id')))
                <button type="button" style="font-family: 'Cairo', sans-serif !important;background-color: #ffc107" class="btn waves-effect waves-light mb-1 add-kanban-btn" id="add-kanban">
                    <i class='material-icons left'>add</i> @lang('front.add_new_board')
                </button>
                <a href="#modal3" style="font-family: 'Cairo', sans-serif !important;background-color: #0b2e13" class="btn waves-effect waves-light mb-1 btn modal-trigger add-kanban-btn users-permissions-button">
                    @lang('front.users')
                </a>
            @else
                <a href="#" style="font-family: 'Cairo', sans-serif !important;background-color: #ffc107" class="btn waves-effect waves-light mb-1 add-kanban-btn disabled" id="add-kanban">
                    <i class='material-icons left'>add</i> @lang('front.add_new_board')
                </a>
                <a href="#" style="font-family: 'Cairo', sans-serif !important;background-color: #0b2e13" disabled class="btn waves-effect waves-light mb-1 btn add-kanban-btn">
                    @lang('front.users')
                </a>
            @endif
            <button type="button" style="font-family: 'Cairo', sans-serif !important;background-color: #5e35b1" class="btn waves-effect waves-light mb-1 collection-item right-sidebar-chat-item sidenav-trigger add-kanban-btn message_board_id" data-id="{{ request()->route()->parameter('id') }}" data-target="slide-out-chat">
                @lang('front.messages')
            </button>
            <a href="#modal-files" style="font-family: 'Cairo', sans-serif !important;background-color: #4e342e" class="btn waves-effect waves-light mb-1 btn modal-trigger add-kanban-btn show-board-files">
                @lang('front.files')
            </a>
            <a href="#modal-logs" style="font-family: 'Cairo', sans-serif !important;background-color: brown" class="btn waves-effect waves-light mb-1 btn modal-trigger add-kanban-btn show-board-logs">
                @lang('front.logs')
            </a>
            <div id="kanban-app"></div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {
            var kanban_curr_el, kanban_curr_item_id, kanban_item_title, kanban_data,
                kanban_item, kanban_users, kanban_curr_item_date;
            // Kanban Board and Item Data passed by json

            var kanban_board_data = [
                    @foreach($myBoard->smallBoards as $small)
                {
                    id: "{{ $small->id }}",
                    title: "{{ $small->title }}",
                    count: "{{ $small->count_number }}",
                    headerBg: "{{ $small['bg-color'] }}",
                    item: [
                            @foreach($small->verySmallBoard as $very)
                                @if(
                                    auth()->user()->hasRole('manager-board-'.request()->route()->parameter('id'))
                                    ||
                                    auth()->user()->hasRole('monitor-board-'.request()->route()->parameter('id'))
                                )
                                    {
                                        id: "{{ $very->id }}",
                                        title: "{{ $very->title }}",
                                        border: "{{ $very->border }}",
                                        @if($very->dueDate != "00/00/0000" && $very->dueDate != null)
                                        dueDate: "{{ $very->dueDate }}",
                                        @endif
                                        board: "{{ $very->board_id }}",
                                        comment: {{ count($very->comments) }},
                                        attachment: {{ count($very->files) }},
                                        @if(!empty($very->users))
                                        users: [
                                            @foreach($very->users as $user)
                                                "{{ url('uploads/users/'.$user->photo) }}",
                                            @endforeach
                                        ]
                                        @endif
                                    },
                                @else
                                    @if($very->belongToThisUser(auth()->user()->id))
                                    {
                                        id: "{{ $very->id }}",
                                        title: "{{ $very->title }}",
                                        border: "{{ $very->border }}",
                                        @if($very->dueDate != "00/00/0000" && $very->dueDate != null)
                                        dueDate: "{{ $very->dueDate }}",
                                        @endif
                                        board: "{{ $very->board_id }}",
                                        comment: {{ count($very->comments) }},
                                        attachment: {{ count($very->files) }},
                                        @if(!empty($very->users))
                                        users: [
                                            @foreach($very->users as $user)
                                                "{{ url('uploads/users/'.$user->photo) }}",
                                            @endforeach
                                        ]
                                        @endif
                                    },
                                    @endif
                                @endif
                            @endforeach
                    ]
                },
                @endforeach
            ];

            // Kanban Board
            let KanbanExample = new jKanban({
                element: "#kanban-app", // selector of the kanban container
                buttonContent: "+ {{ __('front.add_new_item') }}", // text or html content of the board button
                widthBoard: '300px',
                // click on current .kanban-item
                click: function (el) {
                    // kanban-overlay and sidebar display block on click of kanban-item
                    $(".kanban-overlay").addClass("show");
                    $(".kanban-sidebar").addClass("show");

                    // Set el to var kanban_curr_el, use this variable when updating title
                    kanban_curr_el = el;

                    // Extract  the kan ban item & id and set it to respective vars
                    kanban_item_title = $(el).contents()[0].data;
                    kanban_curr_item_id = $(el).attr("data-eid");
                    let kanban_due_date = $(el).data('duedate')
                       ,kanban_border = $(el).data("border");

                    // set id in sidebar
                    $(".item-id").val(kanban_curr_item_id);
                    // set due-date in sidebar
                    $(".edit-kanban-item-date").val(kanban_due_date);
                    // set color in sidebar
                    $("select[name=color] > option").each((index,opt) => {
                        if (opt.value == kanban_border) {
                            $(opt).attr("selected","selected");
                        }
                    });
                    $.ajax({
                        'url' : "{{ route('board.very.small.board.info') }}",
                        'method' : "post",
                        'data' : {id: kanban_curr_item_id,_token: '{{ csrf_token() }}'},
                        success : function (data) {
                            // files
                            // $(".spectacular_files").html("");
                            // data.data.files.forEach((file,index) => {
                            //     $(".spectacular_files").append(`<a target="blank" href="/uploads/home/files/${file.file}">{{ __('front.file') }} ${index+1}</a>`);
                            // });
                            // user start-date
                            $(".edit-start-item-date").val(data.data.startDate);
                            $(".edit-item-date").val(data.data.dueDate);
                            $(".edit-item-duration").val(data.data.duration);
                            // // comments
                            // $(".comments_paragraph").html("");
                            // data.data.comments.forEach((comment) => {
                            //     $(".comments_paragraph").append(`<p>${comment.comment}</p>`);
                            // });
                        },
                        fail : () => {
                            alert('something is wrong');
                        }
                    });


                    // set edit title
                    $(".edit-kanban-item .edit-kanban-item-title").val(kanban_item_title);
                },

                buttonClick: function (el, boardId) {
                    // create a form to add add new element
                    var formItem = document.createElement("form");
                    formItem.setAttribute("class", "itemform");
                    formItem.innerHTML =
                        '<div class="input-field">' +
                        '<textarea class="materialize-textarea add-new-item" rows="2" autofocus required></textarea>' +
                        "</div>" +
                        '<div class="input-field display-flex">' +
                        '<button type="submit" class="btn-floating btn-small mr-2"><i class="material-icons">add</i></button>' +
                        '<button type="button" id="CancelBtn" class="btn-floating btn-small"><i class="material-icons">clear</i></button>' +
                        "</div>";

                    // add new item on submit click
                    KanbanExample.addForm(boardId, formItem);
                    formItem.addEventListener("submit", function (e) {
                        e.preventDefault();
                        let text = e.target[0].value;
                        $.ajax({
                            'url' : "{{ route('board.very.small.board.add') }}",
                            'method' : "post",
                            'data' : {title: text,board_id: boardId,_token: '{{ csrf_token() }}'},
                            success : function (data) {
                                KanbanExample.addElement(boardId, {
                                    title: e.target[0].value,
                                    id: data.data.id,
                                    border: "red",
                                    dueDate: "00/00/0000",
                                    comment: 0,
                                    attachment: 0,
                                    users: [
                                        "{{ url('uploads/users/x.png')}}"
                                    ]
                                });
                                formItem.parentNode.removeChild(formItem);
                            },
                            fail : () => {
                                alert('something is wrong');
                            }
                        });
                    });
                    $(document).on("click", "#CancelBtn", function () {
                        $(this).closest(formItem).remove();
                    })
                },
                addItemButton: true, // add a button to board for easy item creation
                boards: kanban_board_data, // data passed from defined variable
                dragEl : function (el, source) {

                },

                dragendEl: function (el) {
                    $('input[name=to_refresh_realtime]').val("{{ auth()->user()->id }}");
                    // when an item stops dragging
                    let small_board_id = el.parentElement.parentElement.dataset.id;

                    let id = el.dataset.eid;

                    $.ajax({
                        'url' : "{{ route('board.very.small.board.change') }}",
                        'method' : "post",
                        'data' : {small_board_id: small_board_id,id: id,_token: '{{ csrf_token() }}'},
                        success : () => {

                        },
                        fail : () => {
                            alert('something is wrong');
                        }
                    });
                },
            });



            // Add html for Custom Data-attribute to Kanban item
            var board_item_id, board_item_el;
            // Kanban board loop

            for (kanban_data in kanban_board_data) {
                // Kanban board items loop
                for (kanban_item in kanban_board_data[kanban_data].item) {

                    var board_item_details = kanban_board_data[kanban_data].item[kanban_item]; // set item details
                    board_item_id = $(board_item_details).attr("id"); // set 'id' attribute of kanban-item

                    (board_item_el = KanbanExample.findElement(board_item_id)), // find element of kanban-item by ID
                        (board_item_users = board_item_dueDate = board_item_comment = board_item_attachment = board_item_image = board_item_badge =
                            " ");

                    // check if users are defined or not and loop it for getting value from user's array
                    if (typeof $(board_item_el).attr("data-users") !== "undefined") {
                        for (kanban_users in kanban_board_data[kanban_data].item[kanban_item].users) {
                            board_item_users +=
                                '<img class="circle" src=" ' +
                                kanban_board_data[kanban_data].item[kanban_item].users[kanban_users] +
                                '" alt="Avatar" height="24" width="24">';
                        }
                    }
                    // check if dueDate is defined or not
                    if (typeof $(board_item_el).attr("data-dueDate") !== "undefined") {
                        board_item_dueDate =
                            '<div class="kanban-due-date center mb-5 lighten-5 ' + $(board_item_el).attr("data-border") + '"><span class="' + $(board_item_el).attr("data-border") + '-text center"> ' +
                            $(board_item_el).attr("data-dueDate") +
                            "</span>" +
                            "</div>";
                    }
                    // check if comment is defined or not
                    if (typeof $(board_item_el).attr("data-comment") !== "undefined") {
                        board_item_comment =
                            '<div class="kanban-comment display-flex">' +
                            '<i class="material-icons font-size-small">chat_bubble_outline </i>' +
                            '<span class="font-size-small">' +
                            $(board_item_el).attr("data-comment") +
                            "</span>" +
                            "</div>";
                    }
                    // check if attachment is defined or not
                    if (typeof $(board_item_el).attr("data-attachment") !== "undefined") {
                        board_item_attachment =
                            '<div class="kanban-attachment display-flex">' +
                            '<i class="font-size-small material-icons">attach_file</i>' +
                            '<span class="font-size-small">' +
                            $(board_item_el).attr("data-attachment") +
                            "</span>" +
                            "</div>";
                    }
                    // check if Image is defined or not
                    if (typeof $(board_item_el).attr("data-image") !== "undefined") {
                        board_item_image =
                            '<div class="kanban-image mb-1">' +
                            '<img class="responsive-img border-radius-4" src=" ' +
                            kanban_board_data[kanban_data].item[kanban_item].image +
                            '" alt="kanban-image">';
                        ("</div>");
                    }
                    // check if Badge is defined or not
                    if (typeof $(board_item_el).attr("data-badgeContent") !== "undefined") {
                        board_item_badge =
                            '<div class="kanban-badge circle lighten-4 ' +
                            kanban_board_data[kanban_data].item[kanban_item].badgeColor +
                            '">' +
                            '<span class="' + kanban_board_data[kanban_data].item[kanban_item].badgeColor + '-text">' +
                            kanban_board_data[kanban_data].item[kanban_item].badgeContent +
                            "</span>";
                        ("</div>");
                    }
                    // add custom 'kanban-footer'
                    if (
                        typeof (
                            $(board_item_el).attr("data-dueDate") ||
                            $(board_item_el).attr("data-comment") ||
                            $(board_item_el).attr("data-users") ||
                            $(board_item_el).attr("data-attachment")
                        ) !== "undefined"
                    ) {
                        $(board_item_el).append(
                            '<div class="kanban-footer mt-3">' +
                            board_item_dueDate +
                            '<div class="kanban-footer-left left display-flex pt-1">' +
                            board_item_comment +
                            board_item_attachment +
                            "</div>" +
                            '<div class="kanban-footer-right right">' +
                            '<div class="kanban-users">' +
                            board_item_badge +
                            board_item_users +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        );
                    }
                    // add Image prepend to 'kanban-Item'
                    if (typeof $(board_item_el).attr("data-image") !== "undefined") {
                        $(board_item_el).prepend(board_item_image);
                    }
                }
            }
            kanban_board_data.map(function (obj) {
                $(".kanban-board[data-id='" + obj.id + "']").find(".kanban-board-header").addClass(obj.headerBg)
            });


            // Add new kanban board
            //---------------------
            var addBoardDefault = document.getElementById("add-kanban");
            var i = 1;
            addBoardDefault.addEventListener("click", function (e) {
                $.ajax({
                    'url' : "{{ route('board.small.board.add') }}",
                    'method' : "post",
                    'data' : {title: 'Default Title','board_id' : '{{ request()->route()->parameter('id') }}','bg-color': 'cyan',_token: '{{ csrf_token() }}'},
                    success : (data) => {
                        i = data.data.id;
                        KanbanExample.addBoards([
                            {
                                id: i, // generate random id for each new kanban
                                title: "Default Title"
                            }
                        ]);
                        var kanbanNewBoard = KanbanExample.findBoard(i)
                        if (kanbanNewBoard) {
                            var kanban_dropdown = document.createElement("div");
                            kanban_dropdown.setAttribute("class", "dropdown");
                            var kanbanNewBoardData = '<div class="dropdown">' +
                                '<a class="dropdown-trigger" href="#" data-target="kan' + i + '" > <i class="material-icons white-text">more_vert</i></a>' +
                                '<ul id="kan' + i + '" class="dropdown-content">' +
                                '<li><a href="#!" class="change_board_color"><i class="material-icons">link</i><span class="menu-item">Color</span></a></li>' +
                                '<li class="kanban-delete"><a href="#!"><i class="material-icons">delete</i><span class="menu-item">Delete</span></a></li>' +
                                '</ul></div>';
                            var kanbanNewDropdown = $(kanbanNewBoard).find("header");
                            $(kanbanNewDropdown).append(kanbanNewBoardData);
                            $(".dropdown-trigger").dropdown({
                                constrainWidth: false
                            });

                        }
                        i++;
                    },
                    fail : () => {
                        alert('something is wrong');
                    }
                });
            });

            // Delete kanban board
            //---------------------
            $(document).on("click", ".kanban-delete", function (e) {
                var $id = $(this)
                    .closest(".kanban-board")
                    .attr("data-id");
                // addEventListener("click", function () {
                    Swal.fire({
                        title: '{{ __('front.are_you_sure') }}',
                        text: "{{ __('front.You_wont_be_able_to_revert_it') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '{{ __('front.yes_delete') }}',
                        cancelButtonText: '{{ __('front.cancel') }}'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                'url' : "{{ route('board.small.board.remove') }}",
                                'method' : "post",
                                'data' : {id: $id,board_id: '{{ request()->route()->parameter('id') }}',_token: '{{ csrf_token() }}'},
                                success : (data) => {
                                    if (data.status == 1) {
                                        KanbanExample.removeBoard($id);
                                        Swal.fire(
                                            'Deleted!',
                                            '{{ __('front.delete_success') }}.',
                                            'success'
                                        )
                                    } else {
                                        Swal.fire(
                                            'Permission Denied',
                                            'Error',
                                            'error'
                                        )
                                    }
                                },
                                fail : () => {
                                    alert('something is wrong');
                                }
                            });
                        }
                    })
                // });
            });

            // Kanban board dropdown
            // ---------------------

            var kanban_dropdown = document.createElement("div");
            kanban_dropdown.setAttribute("class", "dropdown");
            dropdownKanban();
            function dropdownKanban() {
                kanban_dropdown.innerHTML =
                    '<a class="dropdown-trigger" href="#" data-target="" > <i class="material-icons white-text">more_vert</i></a>' +
                    '<ul id="" class="dropdown-content">' +
                    '<li><a href="#!" class="change_board_color"><i class="material-icons">link</i><span class="menu-item">Color</span></a></li>' +
                    '<li class="kanban-delete"><a href="#!" class="delete_small_board"><i class="material-icons">delete</i><span class="menu-item">Delete</span></a></li>' +
                    '</ul>';
                if (!$(".kanban-board-header div").hasClass("dropdown")) {
                    $(".kanban-board-header").append(kanban_dropdown);
                }
            }

            // Kanban-overlay and sidebar hide
            // --------------------------------------------
            $(
                ".kanban-sidebar .delete-kanban-item, .kanban-sidebar .close-icon, .kanban-sidebar .update-kanban-item, .kanban-overlay"
            ).on("click", function () {
                $(".kanban-overlay").removeClass("show");
                $(".kanban-sidebar").removeClass("show");
            });

            $(document).on("click",".update-kanban-item",function (e) {
                let title = $('#edit-item-title').val();
                let dueDate = $('#edit-item-date').val();
                let startDate = $('#edit-start-item-date').val();
                let duration = $('#edit-item-duration').val();
                let id = $('.item-id').val();
                let labelColor = $('select[name=color]').val();

                let formData = new FormData();
                formData.append('border', labelColor);
                formData.append('id', id);
                formData.append('dueDate', dueDate);
                formData.append('startDate', startDate);
                formData.append('duration', duration);
                formData.append('title', title);
                formData.append('_token',"{{ csrf_token() }}");

                $.ajax({
                    'url' : "{{ route('board.very.small.board.update') }}",
                    'method' : "post",
                    'data' : formData,
                    processData: false,
                    contentType: false,
                    success : (data) => {
                        $('input[name=attachment_file]').val('');
                        let element = $(".kanban-item[data-eid='" + id + "']");
                        // duedate first
                        element.children().children().eq(0).text(dueDate);
                        element.attr('data-duedate',dueDate);

                        // Color Second
                        element.attr('data-border',labelColor);
                        let arr = ['blue','red','green','cyan','orange','blue-grey'];
                        arr.forEach((one) => {
                            if (element.children().children().eq(0).hasClass(one)) {
                                element.children().children().eq(0).removeClass(one);
                            }
                        });
                        element.html('');
                        element.append(`
                            ${title}
                            <div class="kanban-footer mt-3">
                                <div class="kanban-due-date center mb-5 lighten-5 dueDateIsExistOrNot-${data.data.id}">
                                    <span class="-text center"> ${dueDate}</span>
                                </div>
                                <div class="kanban-footer-left left display-flex pt-1">
                                    <div class="kanban-comment display-flex">
                                        <i class="material-icons font-size-small">chat_bubble_outline </i>
                                        <span class="font-size-small">${data.data.comments.length}</span>
                                    </div>
                                    <div class="kanban-attachment display-flex">
                                        <i class="font-size-small material-icons">attach_file</i>
                                        <span class="font-size-small">${data.data.files.length}</span>
                                    </div>
                                </div>
                                <div class="kanban-footer-right right">
                                    <div class="kanban-users element-${data.data.id}">  </div>
                                </div>
                            </div>
                        `);

                        if (data.data.dueDate == "00/00/0000" || data.data.dueDate == null) {
                            $(`.dueDateIsExistOrNot-${data.data.id}`).css('display','none');
                        }

                        element.children().children().eq(0).addClass(labelColor).css("color",labelColor);
                        element.children().children().eq(2).children().html('');
                        if (data.data.users.length > 0){
                            data.data.users.forEach(function (user) {
                                $(`.element-${data.data.id}`).append(`
                                <img class="circle" src="{{ url('uploads/users') }}/${user.photo}" alt="Avatar" height="24" width="24">
                                `);
                            });
                        }

                        let cache = element.children();
                        element.text(title);
                        element.append(cache);
                    },
                    fail : () => {
                        alert('something is wrong');
                    }
                });
            });

            // Change Board Color
            // -------------------
            $(document).on('click','.change_board_color',async function (e){
                e.preventDefault();
                var $id = $(this)
                    .closest(".kanban-board")
                    .attr("data-id");

                const { value: fruit } = await Swal.fire({
                    title: '{{ __('front.change_color') }}',
                    input: 'select',
                    inputOptions: {
                        blue: 'blue',
                        red: 'red',
                        green: 'green',
                        cyan: 'cyan',
                        orange: 'orange',
                        blueGrey: 'blue-grey'
                    },
                    inputPlaceholder: '{{ __('front.color') }}',
                    showCancelButton: true,
                    // inputValidator: (value) => {
                    //
                    // }
                })

                if (fruit) {
                    $.ajax({
                        url: "{{ route('board.small.board.change') }}",
                        method: "post",
                        data: {'_token': '{{ csrf_token() }}','id':$id,'bg-color':fruit},
                        success : function() {
                            // append new color
                            let element = $(".kanban-board[data-id='" + $id + "']").find(".kanban-board-header");
                            let arr = ['blue','red','green','cyan','orange','blue-grey'];
                            arr.forEach((one) => {
                                if (element.hasClass(one)) {
                                    element.removeClass(one);
                                    element.addClass(fruit);
                                }
                            });
                        }
                    });
                }
            });

            // Delete Kanban Item
            // -------------------
            $(document).on("click", ".delete-kanban-item", function () {
                let delete_item = kanban_curr_item_id;

                addEventListener("click", function () {
                    KanbanExample.removeElement(delete_item);

                $.ajax({
                        'url' : "{{ route('board.very.small.board.remove') }}",
                        'method' : "post",
                        'data' : {id: kanban_curr_item_id,_token: '{{ csrf_token() }}'},
                        fail : () => {
                            alert('something is wrong');
                        }
                    });
                });
            });

            // Enable pusher logging - don't include this in production
            // start drag element kanban
                Pusher.logToConsole = true;
                let pusher2 = new Pusher('c94ca2fab6f7c2428792', {
                    cluster: 'eu'
                });
                let channel2 = pusher2.subscribe('update-board-channel');
                channel2.bind('update-board-event', function(data) {
                    if(data.all.user.id != '{{ auth()->user()->id }}'){
                        $(".kanban-item[data-eid='" + data.all.board.id + "']").remove();

                        KanbanExample.addElement(data.all.board.small_board_id, {
                            title: data.all.board.title,
                            id: data.all.board.id,
                            border: data.all.board.border,
                            dueDate: data.all.board.dueDate,
                            comment: data.all.board.comments.length,
                            attachment: data.all.board.files.length
                        });

                        let element = $(".kanban-item[data-eid='" + data.all.board.id + "']");

                        element.html('');
                        element.append(`
                                ${data.all.board.title}
                                <div class="kanban-footer mt-3">
                                    <div class="kanban-due-date center mb-5 lighten-5 ${data.all.board.border} dueDateIsExistOrNot-${data.all.board.id}">
                                        <span class="${data.all.board.border}-text center"> ${data.all.board.dueDate}</span>
                                    </div>
                                    <div class="kanban-footer-left left display-flex pt-1">
                                        <div class="kanban-comment display-flex">
                                            <i class="material-icons font-size-small">chat_bubble_outline </i>
                                            <span class="font-size-small">${data.all.board.comments.length}</span>
                                        </div>
                                        <div class="kanban-attachment display-flex">
                                            <i class="font-size-small material-icons">attach_file</i>
                                            <span class="font-size-small">${data.all.board.files.length}</span>
                                        </div>
                                    </div>
                                    <div class="kanban-footer-right right">
                                        <div class="kanban-users element-${data.all.board.id}">  </div>
                                    </div>
                                </div>
                            `);

                        if (data.all.board.dueDate == "00/00/0000" || data.all.board.dueDate == null) {
                            $(`.dueDateIsExistOrNot-${data.all.board.id}`).css('display','none');
                        }

                        element.children().children().eq(0).addClass(data.all.board.border).css("color",data.all.board.border);
                        element.children().children().eq(2).children().html('');
                        if (data.all.board.users.length > 0){
                            data.all.board.users.forEach(function (user) {
                                $(`.element-${data.all.board.id}`).append(`
                                    <img class="circle" src="{{ url('uploads/users') }}/${user.photo}" alt="Avatar" height="24" width="24">
                                    `);
                            });
                        }

                        let cache = element.children();
                        element.text(data.all.board.title);
                        element.append(cache);
                    }
                });
            // end drag element kanban


            // start delete element kanban
                let pusher3 = new Pusher('c94ca2fab6f7c2428792', {
                    cluster: 'eu'
                });
                let channel3 = pusher3.subscribe('delete-board-channel');
                channel3.bind('delete-board-event', function(data) {
                    if(data.all.user_id != '{{ auth()->user()->id }}') {
                        $(".kanban-item[data-eid='" + data.all.board_id + "']").remove();
                    }
                });
            // end delete element kanban
            //
            // start update old element kanban
                let pusher4 = new Pusher('c94ca2fab6f7c2428792', {
                    cluster: 'eu'
                });
                let channel4 = pusher4.subscribe('update-old-board-channel');
                channel4.bind('update-old-board-event', function(data) {
                    if(data.all.user.id != '{{ auth()->user()->id }}') {
                        let element = $(".kanban-item[data-eid='" + data.all.board.id + "']");

                        element.html('');
                        element.data('border',data.all.board.border);
                        element.append(`
                                ${data.all.board.title}
                                <div class="kanban-footer mt-3">
                                    <div class="kanban-due-date center mb-5 lighten-5 ${data.all.board.border} dueDateIsExistOrNot-${data.all.board.id}">
                                        <span class="${data.all.board.border}-text center"> ${data.all.board.dueDate}</span>
                                    </div>
                                    <div class="kanban-footer-left left display-flex pt-1">
                                        <div class="kanban-comment display-flex">
                                            <i class="material-icons font-size-small">chat_bubble_outline </i>
                                            <span class="font-size-small">${data.all.board.comments.length}</span>
                                        </div>
                                        <div class="kanban-attachment display-flex">
                                            <i class="font-size-small material-icons">attach_file</i>
                                            <span class="font-size-small">${data.all.board.files.length}</span>
                                        </div>
                                    </div>
                                    <div class="kanban-footer-right right">
                                        <div class="kanban-users element-${data.all.board.id}">  </div>
                                    </div>
                                </div>
                            `);

                        if (data.all.board.dueDate == "00/00/0000" || data.all.board.dueDate == null) {
                            $(`.dueDateIsExistOrNot-${data.all.board.id}`).css('display','none');
                        }

                        element.children().children().eq(0).addClass(data.all.board.border).css("color",data.all.board.border);
                        element.children().children().eq(2).children().html('');
                        if (data.all.board.users.length > 0){
                            data.all.board.users.forEach(function (user) {
                                $(`.element-${data.all.board.id}`).append(`
                                    <img class="circle" src="{{ url('uploads/users') }}/${user.photo}" alt="Avatar" height="24" width="24">
                                    `);
                            });
                        }

                        let cache = element.children();
                        element.text(data.all.board.title);
                        element.append(cache);
                    }
                });
            // end update old element kanban
            //

            // start add element kanban
            let pusher5 = new Pusher('c94ca2fab6f7c2428792', {
                cluster: 'eu'
            });
            let channel5 = pusher5.subscribe('add-board-channel');
            channel5.bind('add-board-event', function(data) {
                if(data.all.user.id != '{{ auth()->user()->id }}') {
                    KanbanExample.addElement(data.all.board.small_board_id, {
                        title: data.all.board.title,
                        id: data.all.board.id,
                        border: data.all.board.border,
                        dueDate: data.all.board.dueDate,
                        comment: 0,
                        attachment: 0,
                    });
                }
            });
            // end add element kanban


            // Kanban Quill Editor
            // -------------------
            var composeMailEditor = new Quill(".snow-container .compose-editor", {
                modules: {
                    toolbar: ".compose-quill-toolbar"
                },
                placeholder: "Write a Comment... ",
                theme: "snow"
            });

            // Making Title of Board editable
            // ------------------------------
            $(document).on("mouseenter", ".kanban-title-board", function () {
                $(this).attr("contenteditable", "true");
                $(this).addClass("line-ellipsis");
            });

            $(document).on('blur',".kanban-title-board",function(e) {

                            e.preventDefault();
                            let id = $(this).parent().parent().data('id');
                            $.ajax({
                                'url' : "{{ route('board.small.board.change') }}",
                                'method' : "post",
                                'data' : {id:id,title: $(this).text(),_token: '{{ csrf_token() }}'},
                                fail : () => {
                                    alert('something is wrong');
                                }
                            });

                            $(this).attr("contenteditable", "true");
                            $(this).removeClass("line-ellipsis");
            });

            // Perfect Scrollbar - card-content on kanban-sidebar
            if ($(".kanban-sidebar").length > 0) {
                var ps_sidebar = new PerfectScrollbar(".kanban-sidebar", {
                    theme: "dark",
                    wheelPropagation: false
                });
            }
            // set unique id on all dropdown trigger
            // for (var u = 1; u <= $(".kanban-board").length; u++) {
            //     $(".kanban-board[data-id='" + u + "']").find(".kanban-board-header .dropdown-trigger").attr("data-target", u);
            //     $(".kanban-board[data-id='" + u + "']").find("ul").attr("id", u);
            // }
            for (let board of kanban_board_data)
            {
                $(".kanban-board[data-id='" + board.id + "']").find(".kanban-board-header .dropdown-trigger").attr("data-target", board.id);
                $(".kanban-board[data-id='" + board.id + "']").find("ul").attr("id", board.id);
            }
            // materialise dropdown initialize
            $('.dropdown-trigger').dropdown({
                constrainWidth: false
            });
        });
        $(window).on('resize', function () {
            // sidebar display none on screen resize
            $(".kanban-sidebar").removeClass("show");
            $(".kanban-overlay").removeClass("show");
        });

    </script>

    <script>
        $(document).on('click','.show-board-files',function (){
            let id = '{{ request()->route()->parameter('id') }}';

            $.ajax({
                'url' : "{{ route('board.very.small.board.comments') }}",
                'method' : "post",
                'data' : {id: id,_token: '{{ csrf_token() }}'},
                success : function (data) {
                    // files
                    $(".spectacular_files").html("");
                    data.data.files.forEach((file,index) => {
                        if (file.very_small_board_id == null) {
                            $(".spectacular_files").append(`<a target="blank" href="${file.file}">{{ __('front.public_file') }} ${index+1}</a><br/>`);
                        } else {
                            $(".spectacular_files").append(`<a target="blank" href="${file.file}">{{ __('front.private_file') }} ${file.very_small_board.title} ${index+1}</a><br/>`);
                        }
                    });
                    // comments
                    $(".comments_paragraph").html("");
                    $(".ql-editor").html("");
                    data.data.comments.forEach((comment) => {
                        $(".comments_paragraph").append(
                            `<p>${comment.comment} <span style="font-size: 9px">${ comment.very_small_board !== null ? comment.very_small_board.title : '{{ __('front.public_comment') }}' }</span></p>
                            <p style="text-align: left;font-size: 14px;">${comment.user.name}</p>`
                        );
                    });
                },
                fail : () => {
                    alert('something is wrong');
                }
            });
        });
        $(document).on('click','.auth-google-drive',function (){

        });
        $(document).on('click','.upload-files-board',function (e) {
            e.preventDefault();
            let comment = $('.ql-editor > p').text();
            let id = $('.is-public').val();
            let isPublic = $('.is-public').val();
            let board_id = '{{ request()->route()->parameter('id') }}';
            let formData = new FormData();
            formData.append('file', $('input[name=attachment_file]')[0].files[0]);
            formData.append('comment', comment);
            formData.append('_token',"{{ csrf_token() }}");
            formData.append('board_id', board_id);
            formData.append('id', id);
            formData.append('isPublic',isPublic);
            $.ajax({
                'url' : "{{ route('board.very.small.board.update') }}",
                'method' : "post",
                'data' : formData,
                processData: false,
                contentType: false,
                beforeSend : () => {
                    Swal.showLoading();
                },
                success : (data) => {
                    $('input[name=attachment_file]').val("");
                    $('.ql-editor > p').val("");

                    Swal.hideLoading();
                    Swal.clickConfirm();

                    Swal.fire(
                        "{{ __('front.good_job') }}",
                        "{{ __('front.success_upload') }}",
                        "success"
                    );
                },
                fail : () => {
                    alert('something is wrong');
                }
            });
        });
    </script>

    <script>
        $(document).on('click','.show-board-files',function (e) {
            e.preventDefault();
            let id = '{{ request()->route()->parameter('id') }}';

            $.ajax({
                'url' : "{{ route('board.very.small.board.files') }}",
                'method' : "post",
                'data' : {id:id,_token:'{{ csrf_token() }}'},
                success : (data) => {
                    $('.is-public').html(`<option value="0">@lang('front.for_all')</option>`);
                    data.data.forEach(function (very_small_board) {
                        $('.is-public').append(`
                            <option value="${very_small_board.id}">${very_small_board.title}</option>
                        `);
                    });
                },
                fail : () => {
                    alert('something is wrong');
                }
            });
        });

        $('.show-board-logs').on('click',function (e) {
            e.preventDefault();
            let board_id = '{{ request()->route()->parameter('id') }}';
            $.ajax({
                url: '{{ route('board.logs') }}',
                method: 'post',
                data: {board_id: board_id,_token: '{{ csrf_token() }}'},
                success: function (data) {
                    $('.board-list-logs').html("");
                    data.data.forEach( function (log) {
                        $('.board-list-logs').append(`<tr><td>${log.title}</td></tr>`);
                    });
                }
            });
        });
    </script>

    @if(
    auth()->user()->hasRole('manager-board-'.request()->route()->parameter('id'))
    || auth()->user()->hasRole('monitor-board-'.request()->route()->parameter('id'))
    )
        <div id="modal4" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>@lang('front.users')</h4>
                <table class="table">
                    <tr>
                        <td>@lang('front.users')</td>
                        <td>@lang('front.add')</td>
                    </tr>
                    @csrf
                    <tbody class="users-list-roles">

                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).on('click','.assign-quest-user',function (e) {
                e.preventDefault();
                let very_small_board_id = $('.item-id').val();
                $.ajax({
                    method: 'post',
                    url: '{{ route('board.assign_user') }}',
                    data : {very_small_board_id:very_small_board_id,board_id: '{{ request()->route()->parameter('id') }}',_token: '{{ csrf_token() }}'},
                    success : function (data) {
                        $('.users-list-roles').html('');
                        data.data.users.forEach((user,index) => {
                            $('.users-list-roles').append(`
                        <tr>
                            <td>${user.email}</td>
                            <td>
                                <p class="mb-1">
                                    <label>
                                        <button type="button"
                                            data-id="${user.id}"
                                                style="${data.data.very_small_board
                                                    .users.some( u => u.id == user.id)
                                                    ? 'background-color: #ff9100 !important;' : ''
                                                }"
                                            class="filled-in btn modal-action waves-effect
                                                waves-red btn-flat assign-r"
                                            ><i class="material-icons">done</i>
                                        </button>
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

        </script>
        <script>
            $(document).on('click','.assign-r',function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let very_small_board_id = $('.item-id').val();
                let that = $(this);

                Swal.showLoading();
                $.ajax({
                    method: "post",
                    url: "{{ route('board.assign_user_next') }}",
                    data: {id:id,_token:"{{ csrf_token() }}",very_small_board_id:very_small_board_id},
                    success : (data) => {
                        if (data.data == 1) {
                            that.css({backgroundColor: '#ff9100'});
                        } else {
                            that.css("background-color", "");
                        }
                        Swal.hideLoading();
                        Swal.clickConfirm();
                    }
                })
            });
        </script>
    @else
        <div id="modal4" class="modal">
            <div class="modal-content">
                <h3 style="text-align: center">@lang('front.dont_have_permission')</h3>
            </div>
        </div>
    @endif

    <div id="modal-files" class="modal">
        <div class="modal-content">
            <h5 style="text-align: center">@lang('front.files')</h5>
{{--            <form action="" method="post" enctype="multipart/form-data">--}}
{{--            <input type="button" class="btn btn-success auth-google-drive">--}}

            <div class="file-field input-field">
                    @if(
                        auth()->user()->hasRole('manager-board-'.request()->route()->parameter('id'))
                        ||
                        auth()->user()->hasRole('monitor-board-'.request()->route()->parameter('id'))
                    )
                        <div class="btn btn-file">
                            <span>@lang('front.upload_file')</span>
                            <input type="file" name="attachment_file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    @endif
                </div>
                <div class="input-field">
                    <select class="browser-default form-control is-public">

                    </select>
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
                <button type="submit" class="btn btn-dark modal-close upload-files-board">upload</button>
                <button type="button" style="background-color: grey" class="btn btn-default modal-close">close</button>
{{--            </form>--}}
        </div>
    </div>

    <div id="modal-logs" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>@lang('front.logs')</h4>
            <table class="table">
                <tr>
                    <td>@lang('front.logs')</td>
                </tr>
                @csrf
                <tbody class="board-list-logs">

                </tbody>
            </table>
        </div>
    </div>
@endpush

@push('main-board-settings')
    <input type="hidden" name="to_refresh_realtime">
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
                                            <input type="text" class="edit-kanban-start-item-date datepicker" id="edit-start-item-date" value="{{ now()->format('d/m/Y') }}">
                                            <label for="edit-start-item-date">@lang('front.startdate')</label>
                                        </div>
                                        <div class="input-field">
                                            <input type="text" class="edit-kanban-item-date datepicker" id="edit-item-date" value="{{ now()->format('d/m/y') }}">
                                            <label for="edit-item-date">@lang('front.duedate')</label>
                                        </div>
                                        <div class="input-field">
                                            <input type="number" class="edit-item-duration validate" id="edit-item-duration" placeholder="Duration Mission Per Days">
                                            <label for="edit-item-duration">@lang('front.duration')</label>
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
{{--                                                        <div class="avatar ">--}}
{{--                                                            <img src="{{ url('Front') }}/app-assets/images/avatar/avatar-18.png" class="circle aside-user-photo" height="36" width="36" alt="avtar img holder">--}}
{{--                                                        </div>--}}
                                                        <a href="#modal4" class="btn-floating btn-small pulse ml-10 btn modal-trigger assign-quest-user">
                                                            <i class="material-icons">add</i>
                                                        </a>
                                                    </div>
                                                </div>
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

@push('modals')

@endpush
