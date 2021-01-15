@extends('layouts.app')
@if ($type == 'light')
@section('page', 'Light duty equipment')
@else
@section('page', 'Heavy duty equipment')
@endif
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
                @if (in_array('store_create', \Auth::user()->permission))
                <div class="col-md-7 text-right">
                    <a href="{{ route('store.create', ['type' => $type]) }}">
                        <button type="button" class="btn btn-primary btn-sm">Add Equipment</button>
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
                            <th>Branch</th>
                            @if ($type == 'light')
                            <th>Type</th>
                            @else
                            <th>Plate number</th>
                            <th>Serial number</th>
                            @endif
                            <th>Date</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventory as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->branch->name }}</td>
                            @if ($type == 'light')
                            <td>{{ ucfirst($item->type) . ' duty equipment' }}</td>
                            @else
                            <td>{{ $item->plate_number }}</td>
                            <td>{{ $item->serial_number }}</td>
                            @endif
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if (in_array('store_view', \Auth::user()->permission))
                                <a href="{{ route('store.view', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @endif
                                @if (in_array('store_edit', \Auth::user()->permission))
                                <a href="{{ route('store.edit', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @endif
                                @if (in_array('store_delete', \Auth::user()->permission))
                                <a href="{{ route('store.destroy', ['id' => $item->id]) }}">
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