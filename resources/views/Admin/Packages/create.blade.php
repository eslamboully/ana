@extends('Admin.Layouts.master')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('admin.packages')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}">
                        <li class="breadcrumb-item"><a href="#">@lang('admin.home')</a></li>
                        <li class="breadcrumb-item"><a href="#">@lang('admin.packages')</a></li>
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
                        <form role="form" action="{{ route('admin.packages.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card overflow-hidden">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        @foreach($languages as $index=>$language)
                                                            <li class="nav-item">
                                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="home-tab" data-toggle="tab" href="#{{ str_replace(' ','-',$index) }}" aria-controls="home" role="tab" aria-selected="true">{{ $language }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br/>
                                                    <div class="tab-content">
                                                        @foreach($languages as $index=>$language)
                                                            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="{{ str_replace(' ','-',$index) }}" aria-labelledby="home-tab" role="tabpanel">
                                                                <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-2">
                                                                            <span>العنوان</span>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <input type="text" id="first-name" class="form-control" name="{{ $index }}[title]" value="" placeholder="العنوان">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.manager_num')</label>
                                                <input type="text" name="manager_num" value="{{ old('manager_num') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.manager_num')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.employee_num')</label>
                                                <input type="text" name="employee_num" value="{{ old('employee_num') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.employee_num')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.monitor_num')</label>
                                                <input type="text" name="monitor_num" value="{{ old('monitor_num') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.monitor_num')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.trial_days')</label>
                                                <input type="text" name="trial_days" value="{{ old('trial_days') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.trial_days')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.end_days')</label>
                                                <input type="text" name="end_days" value="{{ old('end_days') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.end_days')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.days')</label>
                                                <input type="text" name="days" value="{{ old('days') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.days')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.price')</label>
                                                <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.price')">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">@lang('admin.icon')</label>
                                                <input type="file" name="icon" value="{{ old('icon') }}" class="form-control" id="exampleInputEmail1" placeholder="@lang('admin.icon')">
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
