@extends('layouts.app')
@section('page', 'Upload letter')
@section('page_description', 'Upload a new letter')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Upload Letter</h5>
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
                <form method="POST" action="{{ route('secretary.letter.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="Letter title" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sender name (optional)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sender_name" placeholder="Sender name" value="{{ old('sender_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sender email (optional)</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="sender_email" placeholder="Sender enail" value="{{ old('sender_email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sender phone (optional)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sender_phone" placeholder="Sender phone" value="{{ old('sender_phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Upload letter</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="file_url" value="{{ old('file_url') }}" placeholder="Select the letter" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description (optional)</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Description" required>{{ old('description') }}</textarea>
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