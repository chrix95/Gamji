@extends('layouts.app')
@section('page', 'Create project milestone')
@section('page_description', 'Create a new project milestone')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create milestone</h5>
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
                <form method="POST" action="{{ route('project.store.milestone', ['project_id' => $project_id]) }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Milestone name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Milestone description" style="resize: none">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start date</label>
                        <div class="col-sm-10">
                            <input id="dropper-default-1" class="form-control dropper-default" min="{{ substr(now(), 0, 10) }}" name="start_date" type="date" value="{{ old('start_date') }}" placeholder="Select a start date" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Expected end date</label>
                        <div class="col-sm-10">
                            <input id="dropper-default-2" class="form-control dropper-default" name="expected_end_date" type="date" value="{{ old('expected_end_date') }}" placeholder="Select a expected end date" />
                        </div>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
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