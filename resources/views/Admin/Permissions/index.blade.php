@extends('Admin/Layouts/master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('admin.permissions') {{ $elements->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}">
                        <li class="breadcrumb-item active">@lang('admin.dashboard')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.permissions.create_related',$elements->id) }}" class="btn btn-warning"><i class="fa fa-plus"></i> @lang('admin.create')</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(session()->has('success'))
                            <p class="label label-success" style="padding: 13px;">{{ session('success') }}</p>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin.name')</th>
                                    <th>@lang('admin.action')</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach($elements->permissions()->get() as $index=>$element)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $element->name }}</td>
                                            <td>
                                                <form action="{{ route('admin.permissions.destroy',$element->name) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="role" value="{{ $elements->name }}">
                                                    <input type="hidden" name="id" value="{{ $elements->id }}">
{{--                                                    <a href="{{ route('admin.permissions.edit',$element->id) }}" class="btn btn-success">--}}
{{--                                                        <i class="fa fa-edit"></i>--}}
{{--                                                    </a>--}}
                                                    <button type="submit" onclick="return confirm('Are You Sure ?')" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin.name')</th>
                                    <th>@lang('admin.action')</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ url('AdminLTE') }}/plugins/datatables/dataTables.bootstrap4.css">
@endpush
@push('js')
    <script src="{{ url('AdminLTE') }}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{ url('AdminLTE') }}/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });
        });
    </script>
@endpush
