@extends('layouts.app')
@section('page', 'Update Equipment')
@section('page_description', 'Update equipment')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Update Equipment</h5>
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
                <form method="POST" action="{{ route('store.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $inventory->name }}">
                        </div>
                    </div>
                    @if ($inventory->type == 'heavy')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Plate number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="plate_number" placeholder="Plate number" value="{{ $inventory->plate_number }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Serial number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="serial_number" placeholder="Serial number" value="{{ $inventory->serial_number }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 1</label>
                        @if ($inventory->docs1 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs1">
                        </div>
                        @else
                        <div class="col-sm-4">
                            <input type="hidden" class="form-control" name="docs1">
                            Document already attached
                        </div>
                        @endif
                        <label class="col-sm-2 col-form-label">Document 2</label>
                        @if ($inventory->docs2 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs2">
                        </div>
                        @else
                        <div class="col-sm-4">
                            <input type="hidden" class="form-control" name="docs2">
                            Document already attached
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 3</label>
                        @if ($inventory->docs3 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs3">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                        <label class="col-sm-2 col-form-label">Document 4</label>
                        @if ($inventory->docs4 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs4">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 5</label>
                        @if ($inventory->docs5 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs5">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                        <label class="col-sm-2 col-form-label">Document 6</label>
                        @if ($inventory->docs6 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs6">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 7</label>
                        @if ($inventory->docs7 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs7">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                        <label class="col-sm-2 col-form-label">Document 8</label>
                        @if ($inventory->docs8 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs8">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Document 9</label>
                        @if ($inventory->docs9 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs9">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                        <label class="col-sm-2 col-form-label">Document 10</label>
                        @if ($inventory->docs10 == NULL)
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="docs10">
                        </div>
                        @else
                        <div class="col-sm-4">
                            Document already attached
                        </div>
                        @endif
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="amount" placeholder="Amount" value="{{ $inventory->amount }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Note (Optional)</label>
                        <div class="col-sm-10">
                            <textarea name="note" class="form-control" cols="30" rows="5" placeholder="Add a note" required>{{ $inventory->note }}</textarea>
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
                                <option @if($inventory->branch_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <input type="hidden" name="type" value="{{ $inventory->type }}">
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