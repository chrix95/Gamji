@extends('layouts.app')
@section('page', 'Edit milestone')
@section('page_description', 'Edit a milestone')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Milestone</h5>
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
                <form method="POST" action="{{ route('project.update.milestone') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" @if($milestone->status == 'completed') disabled @endif placeholder="Milestone name" value="{{ $milestone->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" cols="30" rows="5" @if($milestone->status == 'completed') disabled @endif class="form-control" placeholder="Milestone description" style="resize: none">{{ $milestone->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start date</label>
                        <div class="col-sm-10">
                            <input id="dropper-default-1" class="form-control dropper-default" min="{{ substr(now(), 0, 10) }}" @if($milestone->status == 'completed') disabled @endif name="start_date" type="date" value="{{ $milestone->start_date }}" placeholder="Select a start date" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Expected end date</label>
                        <div class="col-sm-10">
                            <input id="dropper-default-2" class="form-control dropper-default" name="expected_end_date" @if($milestone->status == 'completed') disabled @endif type="date" value="{{ $milestone->expected_end_date }}" placeholder="Select a expected end date" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Update milestone status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control" @if($milestone->status == 'completed') disabled @endif>
                                <option value="" selected disabled>Select a status</option>
                                <option @if($milestone->status == 'created') selected @endif value="created" class="text-primary">Created</option>
                                <option @if($milestone->status == 'ongoing') selected @endif value="ongoing" class="text-info">Ongoing</option>
                                <option @if($milestone->status == 'paused') selected @endif value="paused" class="text-warning">Paused</option>
                                <option @if($milestone->status == 'completed') selected @endif value="completed" class="text-success">Completed</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="milestone_id" value="{{ $milestone->id }}">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-sm" @if($milestone->status == 'completed') disabled @endif>Submit</button>
                            <a href="{{ route('project.view', ['project_code' => $milestone->project->project_code]) }}">
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