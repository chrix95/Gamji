@extends('layouts.app')
@section('page', 'Letters List')
@section('page_description', 'List of all letters')
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
                    <a href="{{ route('secretary.letter.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Upload Letter</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Branch</th>
                            <th>View file</th>
                            <th>Date created</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letters as $value => $item)
                        <tr>
                            <td>{{ $value + 1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td>
                                <a href="{{ asset($item->file_url) }}" target="_blank">
                                    View document
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('secretary.letter.destroy', ['id' => $item->id]) }}">
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