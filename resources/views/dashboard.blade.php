<?php

$admins_count = App\User::where('type',0)->get()->count();

$employees_count = App\User::where('type',2)->get()->count();

$departments_count = App\Models\Department::all()->count();

$requests_count = auth()->user()->requests()->where('check_in','!=',null)->where('check_out','!=',null)->whereMonth('created_at','=',date('m'))->get()->count();

?>

@extends('master.master')

@section('content')

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('dist/js/pages/dashboard.js') }}"></script>
    <div class="row">

        @if(auth()->user()->type == 0)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>

                            {{$admins_count}}

                        </h3>

                        <p>Admins</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>

                            {{$employees_count}}

                        </h3>

                        <p>Employees</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$departments_count}}</h3>

                        <p>Departments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{count($today_requests)}}</h3>

                        <p>available employees</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        @endif

        @if(auth()->user()->type == 2)

            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$absence_days}}</h3>

                        <p>absence days</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{count($monthly_requests)}}</h3>

                        <p>attendance days this month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        @endif

        @if(auth()->user()->type == 1)
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{count($dept_employees)}}</h3>

                        <p>department employees</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{count($available_dept_employees)}}</h3>

                            <p>available employees in {{auth()->user()->department->name}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
        @endif

    </div>
    <!-- /.row -->


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        @if(auth()->user()->type == 0)
                            <div class="card-header">
                                <h3 class="card-title">{{ __('available employees') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('employee name') }}</th>
                                        <th>{{ __('employee email') }}</th>
                                        <th>{{ __('employee department') }}</th>
                                        <th>{{ __('controls') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($today_requests as $request)
                                        <tr>
                                            <td>{{ $request->user()->name }}</td>
                                            <td>{{ $request->user()->email }}</td>
                                            <td>{{ $request->user()->department()->name }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="drop-down-button">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <form action="{{ route('employees.destroy', $request->user()->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this vendor?") }}') ? this.parentElement.submit() : ''">{{ __('delete') }}</button>

                                                        </form>
                                                        <a class="dropdown-item" href="{{ route('employees.edit', $request->user()->id) }}">{{ __('edit') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        @elseif(auth()->user()->type == 1)

                            <div class="card-header">
                                <h3 class="card-title">{{ __('available employees in')  }} {{auth()->user()->department->name}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('employee name') }}</th>
                                        <th>{{ __('employee email') }}</th>
                                        <th>{{ __('employee department') }}</th>
                                        <th>{{ __('controls') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($available_dept_employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->department->name }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="drop-down-button">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this vendor?") }}') ? this.parentElement.submit() : ''">{{ __('delete') }}</button>

                                                        </form>
                                                        <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">{{ __('edit') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->


                        @else

                            <div class="card-header">
                                <h3 class="card-title">{{ __('this month requests') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('check in') }}</th>
                                        <th>{{ __('check out') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthly_requests as $request)
                                        <tr>
                                            <td>{{ $request->check_in }}</td>
                                            <td>{{ $request->check_out }}</td>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->


                        @endif
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>




            <!-- /.card -->
        </section>
        <!-- right col -->
    </div>
    <script>
        $().ready(function(){
            HidefloatButton()
        })
    </script>
@endsection
