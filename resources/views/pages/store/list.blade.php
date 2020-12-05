@extends('layouts.app')
@section('page', 'Equipment List')
@section('page_description', 'List of all equipments')
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
                    <a href="{{ route('store.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Equipment</button>
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
                            <th>Quantity</th>
                            <th>Branch</th>
                            <th>Date</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventory as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('store.view', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('store.edit', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('store.destroy', ['id' => $item->id]) }}">
                                    <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                </a>
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