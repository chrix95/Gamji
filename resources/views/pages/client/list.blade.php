@extends('layouts.app')
@section('page', 'Request')
@section('page_description', 'List of all client')
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
                    <a href="{{ route('project.create.client') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Client</button>
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
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Branch</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item->phone }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                {{ $item->branch !== NULL ? $item->branch->name : 'All branch' }}
                            </td>
                            <td>
                                @if (in_array('client_view', \Auth::user()->permission))
                                <a href="{{ route('project.view.client', ['id' => $item->id]) }}">
                                    <i class="fa fa-eye f-w-600 f-16 m-r-15 text-c-blue"></i>
                                </a>
                                @endif
                                @if (in_array('client_edit', \Auth::user()->permission))
                                <a href="{{ route('project.edit.client', ['client_id' => $item->id]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @endif
                                @if (in_array('client_delete', \Auth::user()->permission))
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