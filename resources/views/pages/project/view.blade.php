@extends('layouts.app')
@section('page', 'Project View')
@section('page_description', 'Project details')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-red">
                <div class="card-body">
                    <div class="row align-items-center m-b-30">
                        <div class="col">
                            <h6 class="m-b-5 text-white">Estimated Cost</h6>
                            <h3 class="m-b-0 f-w-700 text-white">&#8358; {{ number_format($project->estimated_cost, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-blue">
                <div class="card-body">
                    <div class="row align-items-center m-b-30">
                        <div class="col">
                            <h6 class="m-b-5 text-white">Total Expenses</h6>
                            <h3 class="m-b-0 f-w-700 text-white">&#8358; {{ number_format($project->totalExpenses, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-green">
                <div class="card-body">
                    <div class="row align-items-center m-b-30">
                        <div class="col">
                            <h6 class="m-b-5 text-white">Project Completion</h6>
                            <h3 class="m-b-0 f-w-700 text-white">{{ number_format((100/$project->totalMilestones) * $project->completedMilestones, 2) }} %</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card prod-p-card card-yellow">
                <div class="card-body">
                    <div class="row align-items-center m-b-30">
                        <div class="col">
                            <h6 class="m-b-5 text-white">Total Milestones</h6>
                            <h3 class="m-b-0 f-w-700 text-white">{{ $project->totalMilestones }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($project->expected_end_date >= substr(now(), 0, 10))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                The expected timeeline for the {{ $project->project_name }} project is currently <strong>OVERDUE</strong>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>
                                Project Details
                            </h5>
                        </div>
                        @if ($project->status !== 'closed' || $project->status !== 'completed')
                        <div class="col-md-7 text-right">
                            <a href="{{ route('project.create.milestone', ['project_id' => $project->id]) }}">
                                <button type="button" class="btn btn-primary btn-sm">Add Milestone</button>
                            </a>
                            <a href="{{ route('project.edit', ['project_code' => $project->project_code]) }}">
                                <button type="button" class="btn btn-info btn-sm">Edit Project</button>
                            </a>
                            <a href="{{ route('project.expenses.create', ['id' => $project->id]) }}">
                                <button type="button" class="btn btn-danger btn-sm">Add Expenses</button>
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
                                                    <h6 class="d-inline-block"><strong>PROJECT NAME:</strong> {{ strtoupper($project->project_name) }}</h6>
                                                    <label class="label label-info">{{ strtoupper($project->project_code) }}</label>
                                                </div>
                                                <p>
                                                    <strong>CLIENT NAME:</strong> {{ strtoupper($project->client_name) }}
                                                </p>
                                                <p>
                                                    <strong>CLIENT PHONE:</strong> {{ strtoupper($project->client_phone) }}
                                                </p>
                                                <p>
                                                    <strong>START DATE:</strong> {{ strtoupper($project->start_date) }}
                                                </p>
                                                <p>
                                                    <strong>EXPECTED END DATE:</strong> {{ strtoupper($project->expected_end_date) }}
                                                </p>
                                                <p>
                                                    <strong>ESTIMATED COST:</strong> {{ number_format($project->estimated_cost, 2) }}
                                                </p>
                                                <p>
                                                    <strong>STATUS:</strong> 
                                                    @if ($project->status == 'created')
                                                        <span class="label label-primary">{{ ucfirst($project->status) }}</span>
                                                    @elseif ($project->status == 'ongoing')
                                                        <span class="label label-info">{{ ucfirst($project->status) }}</span>
                                                    @elseif ($project->status == 'paused')
                                                        <span class="label label-warning">{{ ucfirst($project->status) }}</span>
                                                    @elseif ($project->status == 'closed')
                                                        <span class="label label-danger">{{ ucfirst($project->status) }}</span>
                                                    @else
                                                        <span class="label label-success">{{ ucfirst($project->status) }}</span>
                                                    @endif
                                                    @if ($project->expected_end_date >= substr(now(), 0, 10))
                                                        <span class="label label-danger">OVERDUE</span>
                                                    @endif
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
        <div class="col-md-12">
            <div class="card proj-progress-card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <h6>Pending milestones</h6>
                            <h5 class="m-b-30 f-w-700">{{ number_format($project->pendingMilestones) }}<span class="text-c-green m-l-10">{{ number_format((100/$project->totalMilestones) * $project->pendingMilestones, 2) }}%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-red" style="width:{{ (100/$project->totalMilestones) * $project->pendingMilestones }}%"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <h6>Ongoing milestones</h6>
                            <h5 class="m-b-30 f-w-700">{{ number_format($project->ongoingMilestones) }}<span class="text-c-green m-l-10">{{ number_format((100/$project->totalMilestones) * $project->ongoingMilestones, 2) }}%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-yellow" style="width:{{ (100/$project->totalMilestones) * $project->ongoingMilestones }}%"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <h6>Paused milestones</h6>
                            <h5 class="m-b-30 f-w-700">{{ number_format($project->pausedMilestones) }}<span class="text-c-red m-l-10">{{ number_format((100/$project->totalMilestones) * $project->pausedMilestones, 2) }}%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-blue" style="width:{{ (100/$project->totalMilestones) * $project->pausedMilestones }}%"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <h6>Completed milestones</h6>
                            <h5 class="m-b-30 f-w-700">{{ number_format($project->completedMilestones) }}<span class="text-c-green m-l-10">{{ number_format((100/$project->totalMilestones) * $project->completedMilestones, 2) }}%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-green" style="width:{{ (100/$project->totalMilestones) * $project->completedMilestones }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>Project Milestones</h5>
                </div>
                <div class="card-block">
                    <div class="scroll-widget">
                        <div class="latest-update-box">
                            @forelse ($project->milestones as $item)
                            <div class="row p-t-20 p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    @if ($item->status == 'created')
                                    <i class="b-primary update-icon ring"></i>
                                    @elseif($item->status == 'paused')
                                    <i class="b-warning update-icon ring"></i>
                                    @elseif($item->status == 'ongoing')
                                    <i class="b-info update-icon ring"></i>
                                    @else
                                    <i class="b-success update-icon ring"></i>
                                    @endif
                                </div>
                                <div class="col p-l-5">
                                    <a href="{{ route('project.edit.milestone', ['milestone_id' => $item->id]) }}"><h6><strong>{{ $item->name }}</strong></h6></a>
                                    <p class="text-muted m-b-0">{{ $item->description }}</p>
                                    <p class="text-muted m-b-0">
                                        <strong>Status:</strong> 
                                        @if ($item->status == 'created')
                                        <span class="label label-primary">{{ ucfirst($item->status) }}</span>
                                        @elseif($item->status == 'ongoing')
                                        <span class="label label-info">{{ ucfirst($item->status) }}</span>
                                        @elseif($item->status == 'paused')
                                        <span class="label label-warning">{{ ucfirst($item->status) }}</span>
                                        @else
                                        <span class="label label-success">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </p>
                                    <p class="text-muted m-b-0"><strong>Expected end date:</strong> {{ $item->expected_end_date }}</p>
                                </div>
                            </div>
                            @empty
                                <p>No milstone for this project <a href="{{ route('project.create.milestone', ['project_id' => $project->id]) }}" class="text-c-blue"> Create a milstone</a></p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection