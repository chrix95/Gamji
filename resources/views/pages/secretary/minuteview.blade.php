@extends('layouts.app')
@section('page', 'Minute View')
@section('page_description', 'Minute details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>
                                Minute Details
                            </h5>
                        </div>
                        <div class="col-md-7 text-right">
                            <a href="{{ route('secretary.minute.edit', ['id' => $minute->id]) }}">
                                <button type="button" class="btn btn-info btn-sm">Edit minute</button>
                            </a>
                            <a href="{{ route('secretary.minute.list') }}">
                                <button type="button" class="btn btn-warning btn-sm">Back to minutes</button>
                            </a>
                        </div>
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
                                                    <h6 class="d-inline-block"><strong>Titlte:</strong> {{ strtoupper($minute->title) }}</h6>
                                                </div>
                                                <br>
                                                <p>
                                                    <strong>Branch:</strong> {{ $minute->branch->name }}
                                                </p>
                                                <p>
                                                    <strong>Attachment:</strong> 
                                                    @if ($minute->file_url !== NULL)
                                                        <a href="{{ asset($minute->file_url) }}" target="_blank">
                                                            <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                    @else
                                                        No attachment
                                                    @endif
                                                </p>
                                                <p>
                                                    <strong>Content:</strong>
                                                </p>
                                                <p>
                                                    {{ $minute->content }}
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