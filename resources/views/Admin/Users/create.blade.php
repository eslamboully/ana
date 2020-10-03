@extends('Admin.Layouts.master')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('admin.users')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}">
                        <li class="breadcrumb-item"><a href="#">@lang('admin.home')</a></li>
                        <li class="breadcrumb-item"><a href="#">@lang('admin.users')</a></li>
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
                        <form role="form" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.name')</label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.name')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.email')</label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.email')">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="exampleInputEmail1">@lang('admin.password')</label>
                                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.password')">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="exampleInputEmail1">@lang('admin.roles')</label>
                                                <select name="role" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
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
