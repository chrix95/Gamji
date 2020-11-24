@extends('layouts.app')
@section('page', 'Create Branch')
@section('page_description', 'Create a new branch')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Branch</h5>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-warning" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('branches.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Branch name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Branch name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Branch phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Branch phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Branch city</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" placeholder="Branch city" value="{{ old('city') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Branch State</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="state" placeholder="Branch state" value="{{ old('state') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Branch Address</label>
                        <div class="col-sm-10">
                            <textarea rows="5" cols="5" class="form-control" name="address" placeholder="Branch address" style="resize: none">{{ old('address') }}</textarea>
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