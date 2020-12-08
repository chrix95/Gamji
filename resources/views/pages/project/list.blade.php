@extends('layouts.app')
@section('page', 'Project List')
@section('page_description', 'List of all project')
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
                    <a href="{{ route('project.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Project</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Project name</th>
                            <th>Project code</th>
                            <th>Branch</th>
                            <th>Start date</th>
                            <th>Expected end date</th>
                            <th>Client name</th>
                            <th>Status</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $item)
                        <tr>
                            <td>{{ $item->project_name }}</td>
                            <td>{{ $item->project_code }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>
                                @if (substr(now(), 0, 10) >= $item->expected_end_date)
                                    <span class="label label-danger">{{ $item->expected_end_date }} - Overdue</span>
                                @else
                                    <span class="label label-warning">{{ $item->expected_end_date }}</span>
                                @endif
                            </td>
                            <td>{{ $item->client_name }}</td>
                            <td>
                                @if ($item->status == 'created')
                                    <span class="label label-primary">{{ ucfirst($item->status) }}</span>
                                @elseif ($item->status == 'ongoing')
                                    <span class="label label-info">{{ ucfirst($item->status) }}</span>
                                @elseif ($item->status == 'paused')
                                    <span class="label label-warning">{{ ucfirst($item->status) }}</span>
                                @elseif ($item->status == 'closed')
                                    <span class="label label-danger">{{ ucfirst($item->status) }}</span>
                                @else
                                    <span class="label label-success">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('project.view', ['project_code' => $item->project_code]) }}">
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('project.edit', ['project_code' => $item->project_code]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                <a href="{{ route('project.destroy', ['id' => $item->id]) }}">
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