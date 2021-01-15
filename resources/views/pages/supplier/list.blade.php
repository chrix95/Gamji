@extends('layouts.app')
@section('page', 'Supplier List')
@section('page_description', 'List of all suppliers')
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
                @if (in_array('supplier_create', \Auth::user()->permission))
                <div class="col-md-7 text-right">
                    <a href="{{ route('supplier.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Supplier</button>
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Join date</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if (in_array('supplier_edit', \Auth::user()->permission))
                                <a href="{{ route('supplier.edit', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @endif
                                @if (in_array('supplier_delete', \Auth::user()->permission))
                                <a href="{{ route('supplier.destroy', ['id' => $item->id]) }}">
                                    <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Default ordering table end -->
@endsection