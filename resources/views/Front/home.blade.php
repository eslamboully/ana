@extends('Front.Layouts.master')

@section('content')
    <div id="kanban-app"></div>
@endsection

@push('js')
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
                        {
                            id: "{{ $very->id }}",
                            title: "{{ $very->title }}",
                            border: "{{ $very->border }}",
                            dueDate: "{{ $very->dueDate }}",
                            board: "{{ $very->board_id }}",
                            comment: {{ count($very->comments) }},
                            attachment: {{ count($very->files) }},
                            {{--users: [--}}
                            {{--    "{{ url('Front') }}/app-assets/images/avatar/avatar-10.png"--}}
                            {{--]--}}
                        },
                        @endforeach
                    ]
                },
                @endforeach
            ];

            // Kanban Board
            var KanbanExample = new jKanban({
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
                        'url' : "{{ route('very.small.board.comments') }}",
                        'method' : "post",
                        'data' : {id: kanban_curr_item_id,_token: '{{ csrf_token() }}'},
                        success : function (data) {
                            // files
                            $(".spectacular_files").html("");
                            data.data.files.forEach((file,index) => {
                                $(".spectacular_files").append(`<a target="blank" href="/uploads/home/files/${file.file}">{{ __('front.file') }} ${index+1}</a>`);
                            });
                            // comments
                            $(".comments_paragraph").html("");
                            data.data.comments.forEach((comment) => {
                                $(".comments_paragraph").append(`<p>${comment.comment}</p>`);
                            });
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
                            'url' : "{{ route('very.small.board.add') }}",
                            'method' : "post",
                            'data' : {title: text,board_id: boardId,_token: '{{ csrf_token() }}'},
                            success : function (data) {

                                KanbanExample.addElement(boardId, {
                                    title: e.target[0].value,
                                    id: data.data.id,
                                    border: "red",
                                    dueDate: "00/00/0000",
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
                    // when an item stops dragging
                    let small_board_id = el.parentElement.parentElement.dataset.id;

                    let id = el.dataset.eid;

                    $.ajax({
                        'url' : "{{ route('very.small.board.change') }}",
                        'method' : "post",
                        'data' : {small_board_id: small_board_id,id: id,_token: '{{ csrf_token() }}'},
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
            addBoardDefault.addEventListener("click", function () {
                let that = $(this);
                $.ajax({
                    'url' : "{{ route('small.board.add') }}",
                    'method' : "post",
                    'data' : {title: 'Default Title','bg-color': 'cyan',_token: '{{ csrf_token() }}'},
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
                                '<li><a href="#!"><i class="material-icons">link</i><span class="menu-item">Copy Link</span></a></li>' +
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
                addEventListener("click", function () {
                    KanbanExample.removeBoard($id);

                    $.ajax({
                        'url' : "{{ route('small.board.remove') }}",
                        'method' : "post",
                        'data' : {id: $id,_token: '{{ csrf_token() }}'},
                        fail : () => {
                            alert('something is wrong');
                        }
                    });
                });
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
                    '<li><a href="#!"><i class="material-icons">link</i><span class="menu-item">Copy Link</span></a></li>' +
                    '<li class="kanban-delete"><a href="#!"><i class="material-icons">delete</i><span class="menu-item">Delete</span></a></li>' +
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

            // Update Kanban Item
            {{--$(document).on("click",".update-kanban-item",function (e) {--}}
            {{--    let title = $('#edit-item-title').val();--}}
            {{--    let dueDate = $('#edit-item-date').val();--}}
            {{--    let id = $('.item-id').val();--}}
            {{--    let labelColor = $('select[name=color]').val();--}}
            {{--    let comment = $('.ql-editor > p').text();--}}
            {{--    let file = $('input[name=attachment_file]').val();--}}

            {{--    $.ajax({--}}
            {{--        'url' : "{{ route('very.small.board.update') }}",--}}
            {{--        'method' : "post",--}}
            {{--        'data' : {id: id,file:file,border:labelColor,title: title,dueDate:dueDate,comment:comment,_token: '{{ csrf_token() }}'},--}}
            {{--        success : () => {--}}

            {{--            let element = $(".kanban-item[data-eid='" + id + "']");--}}
            {{--            // duedate first--}}
            {{--            element.children().children().eq(0).text(dueDate);--}}
            {{--            element.attr('data-duedate',dueDate);--}}
            {{--            // Color Second--}}
            {{--            element.attr('data-border',labelColor);--}}
            {{--            let arr = ['blue','red','green','cyan','orange','blue-grey'];--}}
            {{--            arr.forEach((one) => {--}}
            {{--                if (element.children().children().eq(0).hasClass(one)) {--}}
            {{--                    element.children().children().eq(0).removeClass(one);--}}
            {{--                }--}}
            {{--            });--}}
            {{--            element.children().children().eq(0).addClass(labelColor).css("color",labelColor);--}}

            {{--            let cache = element.children();--}}
            {{--            element.text(title);--}}
            {{--            element.append(cache);--}}
            {{--        },--}}
            {{--        fail : () => {--}}
            {{--            alert('something is wrong');--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}


            $(document).on("click",".update-kanban-item",function (e) {
                let title = $('#edit-item-title').val();
                let dueDate = $('#edit-item-date').val();
                let id = $('.item-id').val();
                let labelColor = $('select[name=color]').val();
                let comment = $('.ql-editor > p').text();

                let formData = new FormData();
                formData.append('file', $('input[name=attachment_file]')[0].files[0]);
                formData.append('comment', comment);
                formData.append('labelColor', labelColor);
                formData.append('id', id);
                formData.append('dueDate', dueDate);
                formData.append('title', title);
                formData.append('_token',"{{ csrf_token() }}");

                $.ajax({
                    'url' : "{{ route('very.small.board.update') }}",
                    'method' : "post",
                    'data' : formData,
                    processData: false,
                    contentType: false,
                    success : () => {
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

                        element.children().children().eq(0).addClass(labelColor).css("color",labelColor);

                        let cache = element.children();
                        element.text(title);
                        element.append(cache);
                    },
                    fail : () => {
                        alert('something is wrong');
                    }
                });
            });

            // Delete Kanban Item
            // -------------------
            $(document).on("click", ".delete-kanban-item", function () {
                let delete_item = kanban_curr_item_id;

                addEventListener("click", function () {
                    KanbanExample.removeElement(delete_item);

                    $.ajax({
                        'url' : "{{ route('very.small.board.remove') }}",
                        'method' : "post",
                        'data' : {id: kanban_curr_item_id,_token: '{{ csrf_token() }}'},
                        fail : () => {
                            alert('something is wrong');
                        }
                    });
                });
            });

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
                                'url' : "{{ route('small.board.change') }}",
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
@endpush
