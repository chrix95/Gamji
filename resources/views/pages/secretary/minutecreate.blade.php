@extends('layouts.app')
@section('page', 'Upload minute')
@section('page_description', 'Upload a new minute')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Upload Minute</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('secretary.minute.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="Letter title" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea name="content" class="form-control" cols="30" rows="5" placeholder="Description" required>{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Upload letter (Optional)</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="file_url" value="{{ old('file_url') }}" placeholder="Select the letter">
                        </div>
                    </div>
                    @if (Auth::user()->branch_id !== NULL)
                        <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">
                    @else
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select a Branch</label>
                        <div class="col-sm-10">
                            <select name="branch_id" class="form-control">
                                <option value="" selected disabled>Select a  option</option>
                                @foreach ($branches as $item)
                                <option @if(old('branch_id') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection