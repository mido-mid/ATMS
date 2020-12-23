@extends('layouts.admin_layout')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Heads') }}</h1>
                        @include('includes.errors')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('heads.index')}}">{{ __('list of heads') }}</a></li>
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

                                    @if(isset($head))
                                        {{ __('edit head') }}
                                    @else
                                        {{ __('add head') }}

                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="@if(isset($head)){{route('heads.update',$head->id) }} @else {{route('heads.store') }} @endif" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if(isset($head))

                                    @method('PUT')

                                @endif

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('name')}}</label>
                                        <input type="text" value="@if(isset($head)){{$head->name }} @endif" name="name" class=" @error('name') is-invalid @enderror form-control" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> {{ __('email') }}</label>
                                        <input type="email" value="@if(isset($head)){{$head->email }} @endif" name="email" class="@error('email') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">New Password</label>
                                        <input type="password" class="@error('password') is-invalid @enderror form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-lg" placeholder="{{ __('Confirm New Password') }}" value="">
                                    </div>

                                    <div class="form-group">
                                        <label>{{__('department')}} </label>
                                        <select class=" @error('department_id') is-invalid @enderror select2" name="department_id" data-placeholder="Select a department" style="width: 100%;" required>
                                            @if(isset($head))
                                                @foreach(\App\Models\Department::all() as $department)

                                                    <option <?php if($head->department->id == $department->id) echo 'selected'; ?> value="{{ $department->id }}">{{ $department->name }}</option>

                                                @endforeach
                                            @else
                                                @foreach(\App\Models\Department::all() as $department)

                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>

                                                @endforeach

                                            @endif
                                        </select>
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @if(isset($head))

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



