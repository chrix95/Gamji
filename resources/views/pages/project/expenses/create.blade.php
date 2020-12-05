@extends('layouts.app')
@section('page', 'Create Expenses')
@section('page_description', 'Create a new expense')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Expenses</h5>
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
                <form method="POST" action="{{ route('project.expenses.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project_code" placeholder="Project name" disabled value="{{ $project->project_name }}">
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="remark" class="form-control" placeholder="Expense description" cols="30" rows="5">{{ old('remark') }}</textarea>
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