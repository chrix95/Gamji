@extends('layouts.app')
@section('page', 'Equipment View')
@section('page_description', 'Equipment details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>
                                Equipemnt Details
                            </h5>
                        </div>
                        <div class="col-md-7 text-right">
                            <a href="{{ route('store.edit', ['id' => $inventory->id]) }}">
                                <button type="button" class="btn btn-info btn-sm">Add Equipemnt</button>
                            </a>
                        </div>
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
                                                    <h6 class="d-inline-block"><strong>EQUIPMENT NAME:</strong> {{ strtoupper($inventory->name) }}</h6>
                                                </div>
                                                <br>
                                                <p>
                                                    <strong>Current quantity:</strong> {{ $inventory->quantity }}
                                                </p>
                                                <p>
                                                    <strong>Description:</strong> {{ $inventory->description }}
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
        <div class="col-sm-6 col-md-6">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>Equipment Log</h5>
                </div>
                <div class="card-block">
                    <div class="scroll-widget">
                        <div class="latest-update-box">
                            @forelse ($inventory->inventory_log as $item)
                            <div class="row p-t-20 p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    @if ($item->type == 'inflow')
                                    <i class="b-success update-icon ring"></i>
                                    @else
                                    <i class="b-danger update-icon ring"></i>
                                    @endif
                                </div>
                                <div class="col p-l-5">
                                    <a href="#">
                                        <h6>
                                            <strong>{{ $inventory->name }}</strong>
                                        </h6>
                                    </a>
                                    <p class="text-muted m-b-0">
                                        <strong>Remark:</strong>
                                        <span>{{ ucfirst($item->remark) }}</span>
                                    </p>
                                    <p class="text-muted m-b-0">
                                        <strong>Quantity:</strong>
                                        {{ $item->quantity }}
                                    </p>
                                    <p class="text-muted m-b-0">
                                        <strong>Status:</strong> 
                                        @if ($item->type == 'inflow')
                                        <span class="label label-success">{{ ucfirst($item->type) }}</span>
                                        @else
                                        <span class="label label-danger">{{ ucfirst($item->type) }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @empty
                                <p>No milstone for this project <a href="{{ route('project.create.milestone', ['project_id' => $project->id]) }}" class="text-c-blue"> Create a milstone</a></p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>Equipment Log</h5>
                </div>
                <div class="card-block">
                    <div class="scroll-widget">
                        <div class="latest-update-box">
                            @forelse ($inventory->stocks as $item)
                            <div class="row p-t-20 p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    @if ($item->type == 'inflow')
                                    <i class="b-success update-icon ring"></i>
                                    @else
                                    <i class="b-danger update-icon ring"></i>
                                    @endif
                                </div>
                                <div class="col p-l-5">
                                    <a href="#">
                                        <h6>
                                            <strong>{{ $inventory->name }}</strong>
                                        </h6>
                                    </a>
                                    <p class="text-muted m-b-0">
                                        <strong>Supplier:</strong>
                                        <span>{{ ucfirst($item->supplier->name) }}</span>
                                    </p>
                                    <p class="text-muted m-b-0">
                                        <strong>Quantity:</strong>
                                        {{ $item->quantity }}
                                    </p>
                                    <p class="text-muted m-b-0">
                                        <strong>Amount:</strong>
                                        {{ $item->amount }}
                                    </p>
                                    <p class="text-muted m-b-0">
                                        <strong>Date supplied:</strong>
                                        {{ substr($item->created_at, 0, 10) }}
                                    </p>
                                </div>
                            </div>
                            @empty
                                <p>No stocks from suppliers yet for this project</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection