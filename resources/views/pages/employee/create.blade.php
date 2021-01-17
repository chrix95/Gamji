@extends('layouts.app')
@section('page', 'Create Employee')
@section('page_description', 'Create a new employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Employee</h5>
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
                <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="employee_code" placeholder="Employee code" value="{{ old('employee_code') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Employee name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Employee email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Employee phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee position</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="position" placeholder="Employee position" value="{{ old('position') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label">
                            Date of Birth
                        </div>
                        <div class="col-sm-10">
                            <input id="dropper-default" class="form-control" name="dob" type="date" max="{{ substr(now(), 0, 10) }}" value="{{ old('dob') }}" placeholder="Select date of birth" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee Address</label>
                        <div class="col-sm-10">
                            <textarea rows="5" cols="5" class="form-control" name="address" placeholder="Employee Address" style="resize: none">{{ old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employement Letter</label>
                        <div class="col-sm-10">
                            <input type="file" name="employment_letter" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <p><strong>Guarantor Information</strong></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Guarantor name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="guarantor_name" placeholder="Guarantor name" value="{{ old('guarantor_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Guarantor phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="guarantor_phone" placeholder="Guarantor phone" value="{{ old('guarantor_phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Guarantor Address</label>
                        <div class="col-sm-10">
                            <textarea rows="5" cols="5" class="form-control" name="guarantor_address" placeholder="Guarantor Address" style="resize: none">{{ old('guarantor_address') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Means of identification</label>
                        <div class="col-sm-10">
                            <input type="file" name="means_of_identification" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <p><strong>Next of Kin Information</strong></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="next_of_kin_name" placeholder="Next of kin name" value="{{ old('next_of_kin_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="next_of_kin_phone" placeholder="Next of kin phone number" value="{{ old('next_of_kin_phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <p><strong>Select permissions</strong></p>
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
                                <option value="NULL">All branches</option>
                                @foreach ($branches as $item)
                                <option @if(old('branch_id') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select desired permissions</label>
                        <div class="col-sm-10">
                            <div class="row">
                                @foreach ($permissions as $item)
                                <div class="col-sm-3">
                                    <label>
                                        <input type="checkbox" name="permission[]" value="{{ $item->code }}"> {{ $item->title }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
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