@extends('layouts.app')
@section('page', 'Client View')
@section('page_description', 'Client details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>
                                Client Details
                            </h5>
                        </div>
                        @if (in_array('client_upload', \Auth::user()->permission))
                        <div class="col-md-7 text-right">
                            <a href="{{ route('project.upload.client', ['client_id' => $client->id]) }}">
                                <button type="button" class="btn btn-success btn-sm">Upload Document</button>
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
                                                    <h6 class="d-inline-block"><strong>Name:</strong> {{ strtoupper($client->name) }}</h6>
                                                </div>
                                                <p>
                                                    <strong>Phone:</strong> {{ $client->phone }}
                                                </p>
                                                <p>
                                                    <strong>Email:</strong> {{ $client->email }}
                                                </p>
                                                <p>
                                                    <strong>Address:</strong> {{ $client->address }}
                                                </p>
                                                <p>
                                                    <strong>Branch:</strong> {{ $client->branch->name }}
                                                </p>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><strong>Uploaded Documents</strong></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (count($client->documents) === 0)
                                                        <div class="col-md-12">
                                                            No document uploaded yet.
                                                        </div>
                                                    @else
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="document-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>Title</th>
                                                                    @if (in_array('client_upload_view', \Auth::user()->permission))
                                                                    <th>Document</th>
                                                                    @endif
                                                                    <th>[ACTION]</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($client->documents as $item)
                                                                <tr>
                                                                    <td>{{ $item->title }}</td>
                                                                    @if (in_array('client_upload_view', \Auth::user()->permission))
                                                                    <td>
                                                                        <a href="{{ asset($item->docs) }}" target="_blank">
                                                                            <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                            View attachment
                                                                        </a>
                                                                    </td>
                                                                    @endif
                                                                    <td>
                                                                        @if (in_array('client_upload_delete', \Auth::user()->permission))
                                                                        <a href="{{ route('project.upload.destroy.client', ['id' => $item->id]) }}">
                                                                            <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                                        </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif
                                                </div>
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