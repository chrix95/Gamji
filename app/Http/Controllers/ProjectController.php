<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use App\Project;
use App\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index (Request $request) {
        $projects = Project::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $projects = $projects->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.project.list', compact('projects'));
    }

    public function create (Request $request) {
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.project.create', compact('branches'));
    }
    
    public function store (Request $request) {
        $data = array(
            'project_name' => $request->project_name,
            'project_code' => $request->project_code,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date,
            'estimated_cost' => $request->estimated_cost,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'project_name' => 'required|string',
            'project_code' => 'required|string|unique:projects',
            'client_name' => 'required|string',
            'client_phone' => 'required|numeric',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date',
            'estimated_cost' => 'required|numeric',
            'branch_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        \Log::info(Auth::user()->branch_id);
        \Log::info($data);
        if (\Auth::user()->branch_id !== NULL) {
            if (\Auth::user()->branch_id != $data['branch_id']) {
                return redirect()->back()->withErrors('Your permission doesn\'t permit you to create a project for this branch')->withInput();
            }
        }
        try {
            Project::create($data);
            Session::flash('success', 'Project created successfully');
            return redirect()->route('project.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function edit (Request $request, $project_code) {
        $project = Project::where('project_code', $project_code)->first();
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        if (!$project) {
            abort(404);
        }
        return view('pages.project.edit', compact('branches', 'project'));
    }

    public function update(Request $request) {
        $project = Project::where('project_code', $request->project_code)->first();
        if (!$project) {
            abort(404);
        }
        $data = array(
            'project_name' => $request->project_name,
            'project_code' => $request->project_code,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date,
            'estimated_cost' => $request->estimated_cost,
            'branch_id' => $request->branch_id,
            'status' => $request->status
        );
        $validator = Validator::make($data, [
            'project_name' => 'required|string',
            'project_code' => 'required|string',
            'client_name' => 'required|string',
            'client_phone' => 'required|numeric',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date',
            'estimated_cost' => 'required|numeric',
            'branch_id' => 'required|integer',
            'status' => 'required|string|in:created,ongoing,paused,completed,closed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $project->update($data);
            return redirect()->route('project.list');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function view (Request $request, $project_code) {
        $project = Project::where('project_code', $project_code)->first();
        if (!$project) {
            abort(404);
        }
        return view('pages.project.view', compact('project'));
    }

    public function destroy (Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $user->delete();
        return redirect()->back();
    }

    public function createMilestone (Request $request, $project_id) {
        return view('pages.project.milestone.create', compact('project_id'));
    }
    
    public function storeMilestone (Request $request, $project_id) {
        $data = array(
            'project_id' => $request->project_id,
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date
        );
        $validator = Validator::make($data, [
            'project_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if ($project_id !== $request->project_id) {
            return redirect()->back()->withErrors('Project ID mismatch')->withInput();
        }
        try {
            $project = Project::find($project_id);
            if(!$project) {
                abort(404);
            }
            $milestone = new Milestone;
            $milestone->name = $data['name'];
            $milestone->description = $data['description'];
            $milestone->start_date = $data['start_date'];
            $milestone->expected_end_date = $data['expected_end_date'];
            $project->milestones()->save($milestone);
            Session::flash('success', 'Milestone has been created successfully');
            return redirect()->route('project.view', ['project_code' => $project->project_code]);   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function editMilestone (Request $request, $milestone_id) {
        $milestone = Milestone::find($milestone_id);
        if (!$milestone) {
            abort(404);
        }
        return view('pages.project.milestone.edit', compact('milestone'));
    }

    public function updateMilestone (Request $request) {
        $milestone = Milestone::find($request->milestone_id);
        if (!$milestone) {
            abort(404);
        }
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date,
            'status' => $request->status
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date',
            'status' => 'required|string|in:created,ongoing,paused,completed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $milestone->update($data);
            return redirect()->route('project.view', ['project_code' => $milestone->project->project_code]);
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }


}
