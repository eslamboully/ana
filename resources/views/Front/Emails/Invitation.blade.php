<html>
    <head>
        <title>Godzilla</title>
    </head>
    <body>
        <div>
            <p>you are invited to {{ $data['board']['name'] }} board from {{ $data['user']['email'] }}</p>
            <form action="{{ route('board.accept_invitation') }}" method="post">
                @csrf
                <a href="{{ route('board.accept_invitation',['board_id' => $data['board']['id']]) }}" target="_blank">Yes, Accept</a>
            </form>
        </div>
    </body>
</html>
