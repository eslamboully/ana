@extends('Admin.Layouts.master')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('admin.related_permissions')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}">
                        <li class="breadcrumb-item"><a href="#">@lang('admin.home')</a></li>
                        <li class="breadcrumb-item"><a href="#">@lang('admin.permissions')</a></li>
                        <li class="breadcrumb-item active">@lang('admin.create')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">@lang('admin.create')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($errors->any())
                            <div class="alert alert-warning" style="margin: 15px;">
                                <ul style="list-style: none;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" action="{{ route('admin.permissions.store_related') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="role" value="{{ $role->id }}">
                                                <label for="exampleInputEmail1">@lang('admin.roles')</label>
                                                <select name="permission" class="form-control">
                                                    @foreach($permissions as $permission)
                                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">@lang('admin.save')</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
