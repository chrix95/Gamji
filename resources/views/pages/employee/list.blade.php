@extends('layouts.app')
@section('page', 'Employee List')
@section('page_description', 'Employee List')
@section('content')
    <!-- Default ordering table start -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    <h5>
                        List
                    </h5>
                </div>
                <div class="col-md-7 text-right">
                    <a href="{{ route('employee.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create User</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employee Code</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Branch</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->employee_code }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td>
                                <a href="{{ route('employee.view', ['employee_code' => $item->employee_code]) }}">
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('employee.edit', ['employee_code' => $item->employee_code]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('employee.destroy', ['id' => $item->id]) }}">
                                    <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                </a>
                                {{-- <a style="color: blue" href="{{ route('employee.view', ['employee_code' => $item->employee_code]) }}" class="btn waves-effect waves-light">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a style="color: green" href="{{ route('employee.edit', ['employee_code' => $item->employee_code]) }}" class="btn waves-effect waves-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a style="color: red" href="{{ route('employee.edit', ['employee_code' => $item->employee_code]) }}" class="btn waves-effect waves-light">
                                    <i class="fas fa-trash"></i>
                                </a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Employee Code</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>[ACTION]</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Default ordering table end -->
@endsection