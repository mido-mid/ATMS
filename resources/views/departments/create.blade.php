@extends('layouts.admin_layout')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Departments') }}</h1>
                        @include('includes.errors')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('departments.index')}}">{{ __('list of departments') }}</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">

                                    @if(isset($department))
                                        {{ __('edit department') }}
                                    @else
                                        {{ __('add department') }}

                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="@if(isset($department)){{route('departments.update',$department->id) }} @else {{route('departments.store') }} @endif" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if(isset($department))

                                    @method('PUT')

                                @endif




                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('name')}}</label>
                                        <input type="text" value="@if(isset($department)){{$department->name }} @endif" name="name" class=" @error('name') is-invalid @enderror form-control" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">

                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>{{__('department arrive time')}}</label>

                                                    <div class="input-group date" id="startpicker" data-target-input="nearest">
                                                        <input type="text" name="start_time" @if(isset($department)) value="{{$department->start_time}}" @endif class="@error('start_time') is-invalid @enderror form-control datetimepicker-input" data-target="#startpicker"/>
                                                        <div class="input-group-append" data-target="#startpicker" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>{{__('department leaving time')}}</label>

                                                    <div class="input-group date" id="endpicker" data-target-input="nearest">
                                                        <input type="text" name="end_time" class="@error('end_time') is-invalid @enderror form-control datetimepicker-input" @if(isset($department)) value="{{$department->end_time}}" @endif data-target="#endpicker"/>
                                                        <div class="input-group-append" data-target="#endpicker" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @if(isset($department))

                                        <button type="submit" class="btn btn-primary">{{ __('edit') }}</button>

                                    @else

                                        <button type="submit" class="btn btn-primary">{{ __('add') }}</button>

                                    @endif
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>


    @endsection



