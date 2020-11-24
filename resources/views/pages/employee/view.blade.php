@extends('layouts.app')
@section('page', 'Employee View')
@section('page_description', 'Employee details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Employe Details</h5>
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
                                                    <h6 class="d-inline-block"><strong>NAME:</strong> {{ strtoupper($user->name) }}</h6>
                                                    <label class="label label-info">{{ strtoupper($user->employee_code) }}</label>
                                                </div>
                                                <p>
                                                    <strong>PHONE:</strong> {{ strtoupper($user->phone) }}
                                                </p>
                                                <p>
                                                    <strong>EMAIL:</strong> {{ strtoupper($user->email) }}
                                                </p>
                                                <p>
                                                    <strong>BRANCH:</strong> {{ strtoupper($user->branch->name) }}
                                                </p>
                                                <p>
                                                    <strong>DATE OF BIRTH:</strong> {{ strtoupper($user->dob) }}
                                                </p>
                                                <p>
                                                    <strong>ADDRESS:</strong> {{ strtoupper($user->address) }}
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