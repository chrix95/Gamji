@extends('layouts.app')
@section('page', 'Employee View')
@section('page_description', 'Employee details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <h5>
                        Employe Details
                    </h5>
                    <a href="{{ route('employee.edit', ['employee_code' => $user->employee_code]) }}" style="float: right;">
                        <button type="button" class="btn btn-sm btn-primary">Edit</button>
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
                                                    <h5><strong>Personal Information</strong></h5>
                                                </div>
                                                <div class="col-xs-12">
                                                    <p class="d-inline-block"><strong>NAME:</strong> {{ strtoupper($user->name) }}</p>
                                                    <label class="label label-info">{{ strtoupper($user->employee_code) }}</label>
                                                </div>
                                                <p>
                                                    <strong>PHONE:</strong> {{ strtoupper($user->phone) }}
                                                </p>
                                                <p>
                                                    <strong>EMAIL:</strong> {{ strtoupper($user->email) }}
                                                </p>
                                                <p>
                                                    <strong>BRANCH:</strong> {{ strtoupper($user->branch ? $user->branch->name : 'All branch') }}
                                                </p>
                                                <p>
                                                    <strong>DATE OF BIRTH:</strong> {{ strtoupper($user->dob) }}
                                                </p>
                                                <p>
                                                    <strong>ADDRESS:</strong> {{ strtoupper($user->address) }}
                                                </p>
                                                <p>
                                                    <strong>LETTER OF EMPLOYMENT:</strong>
                                                    @if ($user->employment_letter !== NULL)
                                                        <a href="{{ asset($user->employment_letter) }}" target="_blank">
                                                            <button type="button" class="btn-sm btn btn-primary">View</button>
                                                        </a>
                                                    @else
                                                        No document found
                                                    @endif
                                                </p>
                                                <br><br>
                                                <div class="col-xs-12">
                                                    <h5><strong>Guarantor Information</strong></h5>
                                                </div>
                                                <p>
                                                    <strong>Name:</strong> {{ strtoupper($user->guarantor_name) }}
                                                </p>
                                                <p>
                                                    <strong>Phone:</strong> {{ strtoupper($user->guarantor_phone) }}
                                                </p>
                                                <p>
                                                    <strong>Address:</strong> {{ strtoupper($user->guarantor_address) }}
                                                </p>
                                                <p>
                                                    <strong>ID Card:</strong> 
                                                    @if ($user->means_of_identification !== NULL)
                                                        <a href="{{ asset($user->means_of_identification) }}" target="_blank">
                                                            <button type="button" class="btn-sm btn btn-primary">View</button>
                                                        </a>
                                                    @else
                                                        No document found
                                                    @endif
                                                </p>
                                                <br><br>
                                                <div class="col-xs-12">
                                                    <h5><strong>Next of Kin</strong></h5>
                                                </div>
                                                <p>
                                                    <strong>Name:</strong> {{ strtoupper($user->next_of_kin_name) }}
                                                </p>
                                                <p>
                                                    <strong>Phone:</strong> {{ strtoupper($user->next_of_kin_phone) }}
                                                </p>
                                                <br><br>
                                                <div class="col-xs-12">
                                                    <h5>
                                                        <strong>Uploaded Documents</strong>
                                                        <span style="float: right">
                                                            <a href="{{ route('employee.docs.create', ['employee_code' => $user->employee_code]) }}">
                                                                <button type="button" class="btn btn-sm btn-primary">Add document</button>
                                                            </a>
                                                        </span>
                                                    </h5>
                                                </div>
                                                <div class="dt-responsive table-responsive">
                                                    <table id="order-table" class="table table-striped table-bordered nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Document</th>
                                                                <th>Date Added</th>
                                                                <th>[ACTION]</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($user->userDocument) == 0)
                                                                <tr>
                                                                    <td colspan="5">
                                                                        No document found
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                @foreach ($user->userDocument as $value => $item)
                                                                <tr>
                                                                    <td>{{ $value + 1 }}</td>
                                                                    <td>{{ $item->title }}</td>
                                                                    <td>
                                                                        <a href="{{ asset($item->docs) }}" target="_blank">
                                                                            <button type="button" class="btn btn-sm btn-primary">view</button>
                                                                        </a>
                                                                    </td>
                                                                    <td>{{ $item->created_at }}</td>
                                                                    <td>
                                                                        <a href="{{ route('employee.docs.destroy', ['id' => $item->id]) }}">
                                                                            <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
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