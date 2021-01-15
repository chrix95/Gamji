@extends('layouts.app')
@section('page', 'Minute List')
@section('page_description', 'List of all minutes')
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
                @if (in_array('minute_create', \Auth::user()->permission))
                <div class="col-md-7 text-right">
                    <a href="{{ route('secretary.minute.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Upload Minute</button>
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
                            <th>#</th>
                            <th>Title</th>
                            <th>Branch</th>
                            <th>Content</th>
                            <th>View file</th>
                            <th>Date created</th>
                            <th>[ACTION]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($minutes as $value => $item)
                        <tr>
                            <td>{{ $value + 1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td>{{ substr($item->content, 0, 70) }}</td>
                            <td>
                                @if ($item->fiel_url !== NULL)
                                <a href="{{ asset($item->file_url) }}" target="_blank" >
                                    View document
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @else
                                No document
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if (in_array('minute_view', \Auth::user()->permission))
                                <a href="{{ route('secretary.minute.view', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @endif
                                @if (in_array('minute_edit', \Auth::user()->permission))
                                <a href="{{ route('secretary.minute.edit', ['id' => $item->id]) }}">
                                    <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                </a>
                                @endif
                                @if (in_array('minute_delete', \Auth::user()->permission))
                                <a href="{{ route('secretary.letter.destroy', ['id' => $item->id]) }}">
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