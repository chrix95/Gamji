@extends('layouts.app')
@section('page', 'Add Equipment')
@section('page_description', 'Add more equipment')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Equipment</h5>
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
                <form method="POST" action="{{ route('store.update') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled name="name" placeholder="Name" value="{{ $inventory->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Description" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select a Supplier</label>
                        <div class="col-sm-10">
                            <select name="supplier_id" class="form-control">
                                <option value="" selected disabled>Select a  option</option>
                                @foreach ($suppliers as $item)
                                <option @if($item->id === $inventory->supplier_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="amount" placeholder="Amount" value="{{ old('amount') }}">
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
                    <input type="hidden" name="id" value="{{ $inventory->id }}">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('store.view', ['id' => $inventory->id]) }}">
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