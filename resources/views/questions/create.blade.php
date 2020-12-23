@extends('layouts.admin_layout')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('َQuestions') }}</h1>
                        @include('includes.errors')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('questions.index')}}">{{ __('list of questions') }}</a></li>
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

                                    @if(isset($question))
                                        {{ __('edit question') }}
                                    @else
                                        {{ __('add question') }}

                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="@if(isset($question)){{route('questions.update',$question->id) }} @else {{route('questions.store') }} @endif" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if(isset($question))

                                    @method('PUT')

                                @endif


                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('description')}}</label>
                                        <input type="text" value="@if(isset($question)){{$question->description }} @endif" name="description" class=" @error('description') is-invalid @enderror form-control" required>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    @if(!isset($question))

                                        <div class="form-group">
                                            <label>question status</label>
                                            <select class=" @error('status') is-invalid @enderror select2"  name="status" data-placeholder="Select a State" style="width: 100%;" required>

                                                <option value="active">active</option>
                                                <option value="inactive">inactive</option>

                                            </select>
                                        </div>

                                    @endif


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @if(isset($question))

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



