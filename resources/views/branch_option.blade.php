@extends('layouts.app')
@section('page', 'Dashboard')
@section('route', 'home')
@section('page_description', 'Analytics and recent updates on projects')
@section('content')
<div class="page-wrapper">
  <div class="page-body">
      <div class="row align-items-center m-b-30">
          <div class="col-md-12">
              <h3 class="text-center">Welcome {{ ucfirst(Auth::user()->name) }} to {{ $branch->name }}, select a module...</h3>
          </div>
      </div>
      <div class="row align-items-center">
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('store.list', ['type' => 'heavy']) }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Heavy duty Machines</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('store.list', ['type' => 'light']) }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Light duty Machines</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('project.list') }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Project module</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('branches.list') }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Admin module</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('secretary.letter.list') }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Letters</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('secretary.minute.list') }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Minutes</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <a href="{{ route('employee.list') }}">
                <div class="card sos-st-card facebook">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-b-0"><i class="fas fa-eye"></i>Employees</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
      </div>
  </div>
</div>
@endsection