<html>
    <head>
        <title>Godzilla</title>
        <link rel="stylesheet" href="{{ url('AdminLTE') }}/dist/css/bootstrap-rtl.min.css">
    </head>
    <body>
        <div>
            <p class="label label-primary">A new task has been added to you in the control panel {{ $data['board']['name'] }} by {{ auth()->user()->email }}</p>
            <a class="btn btn-success" href="{{ route('board.index',['id' => $data['board']['id'],'name' => str_replace(' ','-',$data['board']['name'])]) }}" target="_blank">Look Over</a>

        </div>

        <script src="{{ url('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
