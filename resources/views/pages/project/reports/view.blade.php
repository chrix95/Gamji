@extends('layouts.app')
@section('page', 'Progress report view')
@section('page_description', 'Progress report details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <h5>
                        Progress report
                    </h5>
                    <a href="{{ asset($progress_report->docs) }}" style="float: right;">
                        <button type="button" class="btn btn-sm btn-primary">View attachment</button>
                    </a>
                </div>
                <div class="row card-block">
                    <div class="col-md-12">
                        <ul class="list-view">
                            <li>
                                <div class="list-view-media">
                                    <div class="card-block">
                                        <div class="media">
                                            {{-- <a class="media-left" href="#">
                                                <img class="media-object card-list-img" src="{{ asset('files/assets/images/avatar-2.jpg') }}" alt="Generic placeholder image">
                                            </a> --}}
                                            <div class="media-body">
                                                <div class="col-xs-12">
                                                    <p class="d-inline-block"><strong>TITLE:</strong> {{ strtoupper($progress_report->title) }}</p>
                                                </div>
                                                <p>
                                                    <strong>PROJECT:</strong> {{ strtoupper($progress_report->project->prooject_name) }}
                                                </p>
                                                <p>
                                                    <strong>DESCRIPTION:</strong> {{ strtoupper($progress_report->description) }}
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