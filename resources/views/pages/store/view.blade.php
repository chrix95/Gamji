@extends('layouts.app')
@section('page', 'Equipment View')
@section('page_description', 'Equipment details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>
                                Equipemnt Details
                            </h5>
                        </div>
                        @if (in_array('store_edit', \Auth::user()->permission))
                        <div class="col-md-7 text-right">
                            <a href="{{ route('store.edit', ['id' => $inventory->id]) }}">
                                <button type="button" class="btn btn-info btn-sm">Update Equipment</button>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row card-block">
                    <div class="col-md-12">
                        <ul class="list-view">
                            <li>
                                <div class="list-view-media">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="col-xs-12">
                                                    <h6 class="d-inline-block"><strong>EQUIPMENT NAME:</strong> {{ strtoupper($inventory->name) }}</h6>
                                                </div>
                                                <br>
                                                <p>
                                                    <strong>Equipment Amount:</strong> {{ number_format($inventory->amount, 2) }}
                                                </p>
                                                @if ($inventory->type == 'heavy')
                                                <p>
                                                    <strong>Serial number:</strong> {{ $inventory->serial_number }}
                                                </p>
                                                <p>
                                                    <strong>Plate number:</strong> {{ $inventory->plate_number }}
                                                </p>
                                                @if ($inventory->docs1 !== NULL)
                                                <p>
                                                    <strong>Document 1:</strong> 
                                                    <a href="{{ asset($inventory->docs1) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs2 !== NULL)
                                                <p>
                                                    <strong>Document 2:</strong> 
                                                    <a href="{{ asset($inventory->docs2) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs3 !== NULL)
                                                <p>
                                                    <strong>Document 3:</strong> 
                                                    <a href="{{ asset($inventory->docs3) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs4 !== NULL)
                                                <p>
                                                    <strong>Document 4:</strong> 
                                                    <a href="{{ asset($inventory->docs4) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs5 !== NULL)
                                                <p>
                                                    <strong>Document 5:</strong> 
                                                    <a href="{{ asset($inventory->docs5) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs6 !== NULL)
                                                <p>
                                                    <strong>Document 6:</strong> 
                                                    <a href="{{ asset($inventory->docs6) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs7 !== NULL)
                                                <p>
                                                    <strong>Document 7:</strong> 
                                                    <a href="{{ asset($inventory->docs7) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs8 !== NULL)
                                                <p>
                                                    <strong>Document 8:</strong> 
                                                    <a href="{{ asset($inventory->docs8) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs9 !== NULL)
                                                <p>
                                                    <strong>Document 9:</strong> 
                                                    <a href="{{ asset($inventory->docs9) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if ($inventory->docs10 !== NULL)
                                                <p>
                                                    <strong>Document 10:</strong> 
                                                    <a href="{{ asset($inventory->docs10) }}" target="_blank">
                                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @endif
                                                <p>
                                                    <strong>Note:</strong> {{ $inventory->note ?? 'No note added' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- List view card end -->
        </div>
    </div>
@endsection