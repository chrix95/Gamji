@extends('layouts.app')
@section('page', 'Create Project')
@section('page_description', 'Create a new project')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Project</h5>
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
                <form method="POST" action="{{ route('project.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project_code" placeholder="Project code" value="{{ old('project_code') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project_name" placeholder="Project name" value="{{ old('project_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Client name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="client_name" placeholder="Client name" value="{{ old('client_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Client phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="client_phone" placeholder="Client phone" value="{{ old('client_phone') }}">
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
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Estimated cost</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="estimated_cost" placeholder="Estimated project cost" value="{{ old('estimated_cost') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select a Branch</label>
                        <div class="col-sm-10">
                            <select name="branch_id" class="form-control">
                                <option value="" selected disabled>Select a  option</option>
                                @if (Auth::user()->branch_id !== NULL)
                                <option value="{{ Auth::user()->branch_id }}">{{ Auth::user()->branch->name }}</option>
                                @else
                                @foreach ($branches as $item)
                                <option @if(old('branch_id') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
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