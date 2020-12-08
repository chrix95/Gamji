@extends('layouts.app')
@section('page', 'Dashboard')
@section('route', 'home')
@section('page_description', 'Analytics and recent updates on projects')
@section('content')
<div class="page-wrapper">
    <div class="page-body">
        @if ($notification !== NULL)
            <div class="row align-items-center m-b-30">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <strong>{{ strtoupper($notification->title) }}</strong> <a href="{{ route('notification.list') }}"><span class="b-b-primary text-primary" style="float: right">See all</span></a> <br>
                        {{ substr($notification->content, 0, 200) }}...<br><br>
                        @if ($notification->expected_date !== NULL)
                            <strong>Date: </strong> {{ $notification->expected_date }} <br><br>
                        @endif
                        <a href="{{ route('notification.view', ['id' => $notification->id]) }}">
                            <button type="button" class="btn btn-primary btn-sm">Read more</button>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="row align-items-center m-b-30">
            <div class="col-md-12">
                <h3 class="text-center">Select a branch</h3>
            </div>
        </div>
        <div class="row align-items-center">
            @foreach ($branches as $branch)
                <div class="col-md-12 col-xl-4">
                    <a href="{{ route('select.option.list', ['branch_id' => $branch->id]) }}">
                        <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-b-25">{{ strtoupper($branch->name) }}</h6>
                                        <h3 class="f-w-700 text-c-blue">{{ $branch->phone }}</h3>
                                        <p class="m-b-0">{{ $branch->city . ' ' . $branch->state }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas feather icon-home bg-c-blue"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection