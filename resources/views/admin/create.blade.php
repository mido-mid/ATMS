@extends('layouts.admin_layout')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Admins') }}</h1>
                        @include('includes.errors')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admins.index')}}">{{ __('list of admins') }}</a></li>
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

                                    @if(isset($vendor))
                                        {{ __('edit admin info') }}
                                    @else
                                        {{ __('add admin') }}

                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="@if(isset($admin)){{route('admins.update',$admin->id) }} @else {{route('admins.store') }} @endif" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if(isset($admin))

                                    @method('PUT')

                                @endif




                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('name')}}</label>
                                        <input type="text" value="@if(isset($admin)){{$admin->name }} @endif" name="name" class=" @error('name') is-invalid @enderror form-control" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> {{ __('admin.email') }}</label>
                                        <input type="email" value="@if(isset($admin)){{$admin->email }} @endif" name="email" class="@error('email') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> {{ __('admin.password') }}</label>

                                        <input type="password" class="@error('password') is-invalid @enderror form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>


                                    @if(isset($admin))

                                        <div class="form-group">
                                            <label for="exampleInputFile">{{ __('admin image') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">

                                                    <img style="width:80px;height:80px;margin-right:10px;margin-top: 30px;" src="{{ asset('vendor_images') }}/{{$vendor->image}}" class="card-img-top" alt="Course Photo">

                                                    <input type="checkbox" checked style="margin-right:10px;" name="checkedimage" value="{{$vendor->image}}">

                                                    <input name="image" type="file">

                                                </div>
                                            </div>
                                        </div>
                                    @else

                                        <div class="form-group">
                                            <div class="form-group" style="margin-bottom: 10px">
                                                <label for="exampleInputFile">{{__('admin.logo')}}</label>

                                                 <div class="form-group">

                                                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                                  </div>
                                            </div>
                                        </div>


                                    @endif

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @if(isset($admin))

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



