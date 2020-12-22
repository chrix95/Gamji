@extends('layouts.app')
@section('page', 'Progress report List')
@section('page_description', 'List of all project progress report')
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
                    <a href="{{ route('progress.report.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Upload daily report</button>
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Document uploaded</th>
                            <th>Date added</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $item)
                        <tr>
                            <td>{{ $item->project->project_name }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ substr($item->description, 0, 200) }}</td>
                            <td>
                                @if ($item->docs !== NULL)
                                    <a href="{{ asset($item->docs) }}" target="_blank">
                                        <button type="button" class="btn btn-primary btn-sm">view</button>
                                    </a>
                                @else
                                    No document uploaded
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if (strlen($item->description) > 200)
                                    <a href="{{ route('progress.report.view', ['id' => $item->id]) }}">
                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
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