@extends('layouts.app')
@section('page', 'Update store request')
@section('page_description', 'Update store request')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Update Store request</h5>
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
                <form method="POST" action="{{ route('store.request.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ $type == 'approved' ? 'Approved' : 'Rejected' }} request form</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="approved_request_form" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ $type == 'approved' ? 'Note' : 'Reject Reason' }}</label>
                        <div class="col-sm-10">
                            <textarea name="note" class="form-control" cols="30" rows="5" placeholder="Add a note" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('store.request.view', ['id' => $id]) }}">
                                <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection