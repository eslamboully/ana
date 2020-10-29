<html>
    <head>
        <title>Godzilla</title>
        <link rel="stylesheet" href="{{ url('AdminLTE') }}/dist/css/bootstrap-rtl.min.css">
    </head>
    <body>
        <div>
            <p class="label label-primary">you are invited to {{ $data['board']['name'] }} board from {{ auth()->user()->email }}</p>
            <form action="{{ route('board.accept_invitation') }}" method="post">
                @csrf
                <a class="btn btn-success" href="{{ route('board.accept_invitation',['token'=>'dsa334?rew32GFHR7fw@!#GSADOSAKO#$@32dssfw43543JGH??FSDfsdsdfrewrewdw$%5&^*&346346547456#$%GFsdtreetyttjtTYJ&^%nhg','board_id' => $data['board']['id']]) }}" target="_blank">Yes, Accept</a>
            </form>
        </div>

        <script src="{{ url('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
