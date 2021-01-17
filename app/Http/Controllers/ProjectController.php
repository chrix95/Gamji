<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Branch;
use App\Project;
use App\Milestone;
use App\ProgressReport;
use App\ClientDocument;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
    
    public function progressReportList (Request $request) {
        $reports = ProgressReport::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $projects = Project::where('branch_id', Auth::user()->branch_id)->pluck('id');
            $reports = $reports->whereIN('project_id', $projects);
        }
        return view('pages.project.reports.list', compact('reports'));
    }

    public function progressReportCreate (Request $request) {
        $projects = Project::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $projects = $projects->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.project.reports.create', compact('projects'));
    }

    public function progressReportview (Request $request, $id) {
        $progress_report = ProgressReport::find($id);
        if (!$progress_report) {
            abort(404);
        }
        return view('pages.project.reports.view', compact('progress_report'));
    }

    public function progressReportStore (Request $request) {
        $data = array(
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description
        );
        $validator = Validator::make($data, [
            'project_id' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $project = Project::find($request->project_id);
            if (!$project) {
                return redirect()->back()->withErrors("Project not found")->withInput();
            }
            if($request->hasFile('docs')) {
                $file = Str::slug($data['title']) . time() . '.' . $request->docs->getClientOriginalExtension();
                $file_path = 'reports/upload/';
                $data['docs'] = $file_path . $file;
                $request->file('docs')->move($file_path, $file);
            } else {
                return redirect()->back()->withErrors("Kindly upload a valid document")->withInput();
            }
            $progress_report = new ProgressReport();
            $progress_report->title = $data['title'];
            $progress_report->description = $data['description'];
            $progress_report->docs = $data['docs'];
            $project->progressReport()->save($progress_report);
            Session::flash('success', 'Progress report uploaded successfully');
            return redirect()->route('progress.report.list');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function indexClient (Request $request) {
        $clients = Client::orderBy('id', 'desc')->get();
        if (\Auth::user()->branch_id !== NULL) {
            $clients = $clients->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.client.list', compact('clients'));
    }

    public function createClient (Request $request) {
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.client.create', compact('branches'));
    }

    public function storeClient (Request $request) {
        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable',
            'branch_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if (\Auth::user()->branch_id !== NULL) {
            if (\Auth::user()->branch_id != $data['branch_id']) {
                return redirect()->back()->withErrors('Your permission doesn\'t permit you to create a project for this branch')->withInput();
            }
        }
        try {
            Client::create($data);
            Session::flash('success', 'Client created successfully');
            return redirect()->route('project.list.client');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function editClient (Request $request, $client_id) {
        $client = Client::find($client_id);
        $branches = Branch::all();
        if (!$client) {
            abort(404);
        }
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.client.edit', compact('client', 'branches'));
    }

    public function updateClient (Request $request) {
        $client = Client::where('id', $request->client_id)->first();
        if (!$client) {
            abort(404);
        }
        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable',
            'branch_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $client->update($data);
            return redirect()->route('project.list.client');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function destroyClient (Request $request, $id) {
        $client = Client::find($id);
        if (!$client) {
            abort(404);
        }
        foreach ($client->documents as $value) {
            if(file_exists($value->docs)) {
                File::delete($value->docs);
            }
            @unlink($value->docs);
            $value->delete();
        }
        $client->delete();
        return redirect()->back();
    }

    public function viewClient (Request $request, $id) {
        $client = Client::find($id);
        if (!$client) {
            abort(404);
        }
        return view('pages.client.view', compact('client'));
    }

    public function uploadClient (Request $request, $client_id) {
        return view('pages.client.upload', compact('client_id'));
    }

    public function storeUploadClient (Request $request) {
        $client = Client::find($request->client_id);
        if (!$client) {
            return redirect()->back()->withErrors("Client not found")->withInput();
        }
        $data = array(
            'client_id' => $request->client_id,
            'title1' => $request->title1,
            'docs1' => $request->docs1,
            'title2' => $request->title2,
            'docs2' => $request->docs2,
            'title3' => $request->title3,
            'docs3' => $request->docs3,
            'title4' => $request->title4,
            'docs4' => $request->docs4,
            'title5' => $request->title5,
            'docs5' => $request->docs5
        );
        $validator = Validator::make($data, [
            'client_id' => 'required|integer',
            'title1' => 'nullable|string',
            'docs1' => 'nullable|file',
            'title2' => 'nullable|string',
            'docs2' => 'nullable|file',
            'title3' => 'nullable|string',
            'docs3' => 'nullable|file',
            'title4' => 'nullable|string',
            'docs4' => 'nullable|file',
            'title5' => 'nullable|string',
            'docs5' => 'nullable|file'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            if($request->hasFile('docs1')) {
                $file = $data['title1'] ? Str::slug($data['title1']) . time() . '.' . $request->docs1->getClientOriginalExtension() : Str::slug($client->name) . time() . '.' . $request->docs1->getClientOriginalExtension();
                $file_path = "documents/" . Str::slug($client->name) . "/upload/";
                $request->file('docs1')->move($file_path, $file);
                $data['docs'] = $file_path . $file;
                $clientDocument = new ClientDocument();
                $clientDocument->title = $data['title1'] ? Str::slug($data['title1']) . time() : Str::slug($client->name) . time();
                $clientDocument->docs = $file_path . $file;
                $client->documents()->save($clientDocument);
            }
            if($request->hasFile('docs2')) {
                $file = $data['title1'] ? Str::slug($data['title1']) . time() . '.' . $request->docs2->getClientOriginalExtension() : Str::slug($client->name) . time() . '.' . $request->docs2->getClientOriginalExtension();
                $file_path = "documents/" . Str::slug($client->name) . "/upload/";
                $request->file('docs2')->move($file_path, $file);
                $data['docs'] = $file_path . $file;
                $clientDocument = new ClientDocument();
                $clientDocument->title = $data['title1'] ? Str::slug($data['title1']) . time() : Str::slug($client->name) . time();
                $clientDocument->docs = $file_path . $file;
                $client->documents()->save($clientDocument);
            }
            if($request->hasFile('docs3')) {
                $file = $data['title1'] ? Str::slug($data['title1']) . time() . '.' . $request->docs3->getClientOriginalExtension() : Str::slug($client->name) . time() . '.' . $request->docs3->getClientOriginalExtension();
                $file_path = "documents/" . Str::slug($client->name) . "/upload/";
                $request->file('docs3')->move($file_path, $file);
                $data['docs'] = $file_path . $file;
                $clientDocument = new ClientDocument();
                $clientDocument->title = $data['title1'] ? Str::slug($data['title1']) . time() : Str::slug($client->name) . time();
                $clientDocument->docs = $file_path . $file;
                $client->documents()->save($clientDocument);
            }
            if($request->hasFile('docs4')) {
                $file = $data['title1'] ? Str::slug($data['title1']) . time() . '.' . $request->docs4->getClientOriginalExtension() : Str::slug($client->name) . time() . '.' . $request->docs4->getClientOriginalExtension();
                $file_path = "documents/" . Str::slug($client->name) . "/upload/";
                $request->file('docs4')->move($file_path, $file);
                $data['docs'] = $file_path . $file;
                $clientDocument = new ClientDocument();
                $clientDocument->title = $data['title1'] ? Str::slug($data['title1']) . time() : Str::slug($client->name) . time();
                $clientDocument->docs = $file_path . $file;
                $client->documents()->save($clientDocument);
            }
            if($request->hasFile('docs5')) {
                $file = $data['title1'] ? Str::slug($data['title1']) . time() . '.' . $request->docs5->getClientOriginalExtension() : Str::slug($client->name) . time() . '.' . $request->docs5->getClientOriginalExtension();
                $file_path = "documents/" . Str::slug($client->name) . "/upload/";
                $request->file('docs5')->move($file_path, $file);
                $data['docs'] = $file_path . $file;
                $clientDocument = new ClientDocument();
                $clientDocument->title = $data['title1'] ? Str::slug($data['title1']) . time() : Str::slug($client->name) . time();
                $clientDocument->docs = $file_path . $file;
                $client->documents()->save($clientDocument);
            }
            Session::flash('success', 'Client document uploaded successfully');
            return redirect()->route('project.view.client', ['id' => $client->id]);
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function destroyUploadClient (Request $request, $id) {
        $document = ClientDocument::find($id);
        if (!$document) {
            abort(404);
        }
        if(file_exists($document->docs)) {
            File::delete($document->docs);
        }
        @unlink($document->docs);
        $document->delete();
        return redirect()->back();
    }

}
