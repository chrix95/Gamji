@extends('layouts.app')
@section('page', 'Upload documents')
@section('page_description', 'Upload a new documents')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Upload documents</h5>
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
                <form method="POST" action="{{ route('project.upload.store.client') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document Title</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title1">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 1</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document Title</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title2">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 2</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document Title</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title3">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 3</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document Title</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title4">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 4</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document Title</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title5">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 5</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs5">
                        </div>
                    </div>
                    <input type="hidden" name="client_id" value="{{ $client_id }}">
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