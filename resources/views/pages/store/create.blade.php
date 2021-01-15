@extends('layouts.app')
@section('page', 'Create equipment')
@section('page_description', 'Create a new equipment')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Equipment</h5>
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
                <form method="POST" action="{{ route('store.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                        </div>
                    </div>
                    @if ($type == 'heavy')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Plate number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="plate_number" placeholder="Plate number" value="{{ old('plate_number') }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Serial number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="serial_number" placeholder="Serial number" value="{{ old('serial_number') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 1</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs1">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 2</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 3</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs3">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 4</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 5</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs5">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 6</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs6">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 7</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs7">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 8</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs8">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 9</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs9">
                        </div>
                        <label class="col-sm-2 col-form-label">Document 10</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs10">
                        </div>
                    </div>
                    @endif
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
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Note (Optional)</label>
                        <div class="col-sm-10">
                            <textarea name="note" class="form-control" cols="30" rows="5" placeholder="Description">{{ old('note') }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="{{ $type }}">
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