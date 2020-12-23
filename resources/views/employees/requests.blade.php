@extends('layouts.admin_layout')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Employee requests') }}</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <form action="{{ route('check_in', auth()->user()->id) }}" method="post">
                                @csrf

                                <li class="breadcrumb-item"><button class="btn btn-block btn-primary"  onclick="confirm('{{ __("Are you sure you want to check in ?") }}') ? this.parentElement.submit() : ''"><i class="far fa-check-circle"></i> {{ __('check in') }}</button></li>

                            </form>
                        </ol>
                    </div>


                    <div class="col-12">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('employees') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('check_in') }}</th>
                                        <th>{{ __('check_out') }}</th>
                                        <th>{{ __('status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>{{$request->check_in}}</td>
                                            <td>
                                                @if($request->check_out != null)

                                                    {{$request->check_out}}

                                                @else

                                                    <form action="{{ route('check_out', $request->id) }}" method="post">
                                                        @csrf

                                                        <button class="btn btn-block btn-primary"  onclick="confirm('{{ __("Are you sure you want to check out ?") }}') ? this.parentElement.submit() : ''"><i class="far fa-check-circle"></i> {{ __('check out') }}</button></li>

                                                    </form>


                                                @endif

                                            </td>
                                            <td>{{$request->status}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection



