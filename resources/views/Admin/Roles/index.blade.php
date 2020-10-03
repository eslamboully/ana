@extends('Admin/Layouts/master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('admin.roles')</h1>
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
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i> @lang('admin.create')</a>
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
                                    @foreach($elements as $index=>$element)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $element->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.permissions.index',$element->id) }}" class="btn btn-warning">
                                                    @lang('admin.related_permissions')
                                                    <i class="fa fa-eye"></i>
                                                </a>
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
