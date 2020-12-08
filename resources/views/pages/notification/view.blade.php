@extends('layouts.app')
@section('page', 'Notification View')
@section('page_description', 'Notification details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Notification Details</h5>
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
                                                    <h6 class="d-inline-block"><strong>TITLE:</strong> {{ strtoupper($notification->title) }}</h6>
                                                    @if ($notification->expected_date !== NULL)
                                                    <label class="label label-info"><strong>DATE: </strong> {{ strtoupper($notification->expected_date) }}</label>
                                                    @endif
                                                </div>
                                                <p>
                                                   {{ $notification->content }}
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