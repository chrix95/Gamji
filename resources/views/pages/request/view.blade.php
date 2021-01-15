@extends('layouts.app')
@section('page', 'Request View')
@section('page_description', 'Request details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>
                                Request Details
                            </h5>
                        </div>
                        @if (in_array('store_approval', \Auth::user()->permission) && $storeRequest->status == 'pending')
                        <div class="col-md-7 text-right">
                            <a href="{{ route('store.request.edit', ['type' => 'approved', 'id' => $storeRequest->id]) }}">
                                <button type="button" class="btn btn-success btn-sm">Approve Request</button>
                            </a>
                            <a href="{{ route('store.request.edit', ['type' => 'rejected', 'id' => $storeRequest->id]) }}">
                                <button type="button" class="btn btn-danger btn-sm">Reject Request</button>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row card-block">
                    <div class="col-md-12">
                        <ul class="list-view">
                            <li>
                                <div class="list-view-media">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="col-xs-12">
                                                    <h6 class="d-inline-block"><strong>Requested by:</strong> {{ strtoupper($storeRequest->user->name) }}</h6>
                                                </div>
                                                <br>
                                                <p>
                                                    <strong>Branch:</strong> {{ $storeRequest->branch->name }}
                                                </p>
                                                @if ($storeRequest->request_form !== NULL)
                                                <p>
                                                    <strong>Request form:</strong> 
                                                    <a href="{{ asset($storeRequest->request_form) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                <p>
                                                    <strong>Machines | Serial number:</strong>
                                                    <ol>
                                                        @foreach ($storeRequest->machines as $item)
                                                        <li>
                                                            {{ $item }}
                                                        </li>
                                                        @endforeach
                                                    </ol>
                                                </p>
                                                @if ($storeRequest->status == 'approved')
                                                @if ($storeRequest->approved_request_form !== NULL)
                                                <p>
                                                    <strong>Approved Request form:</strong> 
                                                    <a href="{{ asset($storeRequest->approved_request_form) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                <p>
                                                    <strong>Approved by:</strong> {{ $storeRequest->approved_by }}
                                                </p>
                                                <p>
                                                    <strong>Approval date:</strong> {{ $storeRequest->approval_date }}
                                                </p>
                                                @endif
                                                @if ($storeRequest->status == 'rejected') 
                                                <p>
                                                    <strong>Reject reason:</strong> {{ $storeRequest->reject_reason }}
                                                </p>
                                                @endif
                                                <p>
                                                    <strong>Status:</strong> 
                                                    @if ($storeRequest->status == 'pending')
                                                        <span class="label label-info">{{ ucfirst($storeRequest->status) }}</span>
                                                    @elseif ($storeRequest->status == 'approved')
                                                        <span class="label label-success">{{ ucfirst($storeRequest->status) }}</span>
                                                    @else
                                                        <span class="label label-danger">{{ ucfirst($storeRequest->status) }}</span>
                                                    @endif
                                                </p>
                                                <p>
                                                    <strong>Note:</strong> {{ $storeRequest->note ?? 'No note added' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- List view card end -->
        </div>
    </div>
@endsection