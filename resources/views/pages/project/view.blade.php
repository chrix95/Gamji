@extends('layouts.app')
@section('page', 'Project View')
@section('page_description', 'Project details')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h5>Project Details</h5>
                        </div>
                        <div class="col-md-7 text-right">
                            <a href="{{ route('project.create') }}">
                                <button type="button" class="btn btn-primary btn-sm">Add Milestone</button>
                            </a>
                            <a href="{{ route('project.edit', ['project_code' => $project->project_code]) }}">
                                <button type="button" class="btn btn-info btn-sm">Edit Project</button>
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
                                                    <strong>ESTIMATED COST:</strong> {{ strtoupper($project->estimated_cost) }}
                                                </p>
                                                <p>
                                                    <strong>STATUS:</strong> 
                                                    @if ($project->status == 'created')
                                                        <span class="text-primary">{{ ucfirst($project->status) }}</span>
                                                    @elseif ($project->status == 'ongoing')
                                                        <span class="text-info">{{ ucfirst($project->status) }}</span>
                                                    @elseif ($project->status == 'paused')
                                                        <span class="text-warning">{{ ucfirst($project->status) }}</span>
                                                    @elseif ($project->status == 'closed')
                                                        <span class="text-danger">{{ ucfirst($project->status) }}</span>
                                                    @else
                                                        <span class="text-success">{{ ucfirst($project->status) }}</span>
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
                                    <i class="b-info update-icon ring"></i>
                                    @elseif($item->status == 'ongoing')
                                    <i class="b-warning update-icon ring"></i>
                                    @else
                                    <i class="b-success update-icon ring"></i>
                                    @endif
                                </div>
                                <div class="col p-l-5">
                                    <a href="#!"><h6>{{ $item->name }}</h6></a>
                                    <p class="text-muted m-b-0">{{ sub_str($item->description, 0, 20) }}, <a href="#!" class="text-c-blue"> More</a></p>
                                </div>
                            </div>
                            @empty
                                <p>No milstone for this project <a href="#!" class="text-c-blue"> Create a milstone</a></p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection