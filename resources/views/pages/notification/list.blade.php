@extends('layouts.app')
@section('page', 'Notification List')
@section('page_description', 'Notification List')
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
                    <a href="{{ route('notification.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Notification</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Branch</th>
                            <th>Expected date</th>
                            <th>Date created</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->title }}</td>
                            <td>{{ $notification->branch_id !== NULL ? $notification->branch->name : 'All branches' }}</td>
                            <td>{{ $notification->expected_date ?? 'No event date' }}</td>
                            <td>{{ $notification->created_at }}</td>
                            <td>
                                <a href="{{ route('notification.view', ['id' => $notification->id]) }}">
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('notification.edit', ['id' => $notification->id]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('notification.destroy', ['id' => $notification->id]) }}">
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