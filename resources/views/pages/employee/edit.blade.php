@extends('layouts.app')
@section('page', 'Edit Employee')
@section('page_description', 'Edit a employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Employee</h5>
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
                <form method="POST" action="{{ route('employee.update') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="employee_code" placeholder="Employee code" value="{{ $user->employee_code }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Employee name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Employee email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Employee phone" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select a Branch</label>
                        <div class="col-sm-10">
                            <select name="branch_id" class="form-control">
                                <option value="" selected disabled>Select a  option</option>
                                @foreach ($branches as $item)
                                <option @if($user->branch_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label">
                            Date of Birth
                        </div>
                        <div class="col-sm-10">
                            <input id="dropper-default" class="form-control" name="dob" type="text" value="{{ $user->dob }}" placeholder="Select date of birth" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee Address</label>
                        <div class="col-sm-10">
                            <textarea rows="5" cols="5" class="form-control" name="address" placeholder="Employee Address" style="resize: none">{{ $user->address }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">
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