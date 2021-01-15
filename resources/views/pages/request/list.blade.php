@extends('layouts.app')
@section('page', 'Request')
@section('page_description', 'List of all request')
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
                @if (in_array('store_request', \Auth::user()->permission))
                <div class="col-md-7 text-right">
                    <a href="{{ route('store.request.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Request</button>
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
                            <th>Machines</th>
                            <th>Request form</th>
                            <th>Status</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storeRequest as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                @foreach ($item->machines as $i)
                                    {{ $i }}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ asset($item->request_form) }}" target="_blank">
                                    View document
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                            </td>
                            <td>
                                @if ($item->status == 'pending')
                                    <span class="label label-info">{{ ucfirst($item->status) }}</span>
                                @elseif ($item->status == 'approved')
                                    <span class="label label-success">{{ ucfirst($item->status) }}</span>
                                @else
                                    <span class="label label-danger">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if (in_array('store_request', \Auth::user()->permission))
                                <a href="{{ route('store.request.view', ['id' => $item->id]) }}">
                                    <i class="fa fa-eye f-w-600 f-16 m-r-15 text-c-blue"></i>
                                </a>
                                @endif
                                @if (in_array('store_request_delete', \Auth::user()->permission))
                                <a href="{{ route('store.request.destroy', ['id' => $item->id]) }}">
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