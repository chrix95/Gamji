<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use App\Project;
use App\Stock;
use App\Milestone;
use App\Inventory;
use App\Supplier;
use App\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index (Request $request, $type) {
        $inventory = Inventory::where('type', $type)->orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $inventory = $inventory->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.store.list', compact('inventory', 'type'));
    }

    public function create (Request $request, $type) {
        $suppliers = Supplier::orderBy('name', 'asc')->get(['id', 'name']);
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.store.create', compact('branches', 'suppliers', 'type'));
    }
    
    public function store (Request $request) {
        $data = array(
            'name' => $request->name,
            'amount' => $request->amount ?? 0.00,
            'plate_number' => $request->plate_number,
            'serial_number' => $request->serial_number,
            'docs1' => $request->docs1,
            'docs2' => $request->docs2,
            'docs3' => $request->docs3,
            'docs4' => $request->docs4,
            'docs5' => $request->docs5,
            'docs6' => $request->docs6,
            'docs7' => $request->docs7,
            'docs8' => $request->docs8,
            'docs9' => $request->docs9,
            'docs10' => $request->docs10,
            'branch_id' => $request->branch_id,
            'branch_id' => $request->branch_id,
            'note' => $request->note,
            'type' => $request->type,
        );
        if ($request->type == 'light') {
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'amount' => 'numeric',
                'note' => 'nullable',
                'branch_id' => 'required|integer'
            ]);
        } else {
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'plate_number' => 'required|string',
                'serial_number' => 'required|string',
                'amount' => 'nullable',
                'docs1' => 'nullable',
                'docs2' => 'nullable',
                'docs3' => 'nullable',
                'docs4' => 'nullable',
                'docs5' => 'nullable',
                'docs6' => 'nullable',
                'docs7' => 'nullable',
                'docs8' => 'nullable',
                'docs9' => 'nullable',
                'docs10' => 'nullable',
                'note' => 'nullable',
                'branch_id' => 'required|integer'
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if (\Auth::user()->branch_id !== NULL) {
            if (\Auth::user()->branch_id != $data['branch_id']) {
                return redirect()->back()->withErrors('Your permission doesn\'t permit you to create a project for this branch')->withInput();
            }
        }
        try {
            if($request->hasFile('docs1')) {
                $file = time() . '.' . $request->docs1->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs1'] = $file_path . $file;
                $request->file('docs1')->move($file_path, $file);
            }
            if($request->hasFile('docs2')) {
                $file = time() . '.' . $request->docs2->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs2'] = $file_path . $file;
                $request->file('docs2')->move($file_path, $file);
            }
            if($request->hasFile('docs3')) {
                $file = time() . '.' . $request->docs3->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs3'] = $file_path . $file;
                $request->file('docs3')->move($file_path, $file);
            }
            if($request->hasFile('docs4')) {
                $file = time() . '.' . $request->docs4->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs4'] = $file_path . $file;
                $request->file('docs4')->move($file_path, $file);
            }
            if($request->hasFile('docs5')) {
                $file = time() . '.' . $request->docs5->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs5'] = $file_path . $file;
                $request->file('docs5')->move($file_path, $file);
            }
            if($request->hasFile('docs6')) {
                $file = time() . '.' . $request->docs6->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs6'] = $file_path . $file;
                $request->file('docs6')->move($file_path, $file);
            }
            if($request->hasFile('docs7')) {
                $file = time() . '.' . $request->docs7->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs7'] = $file_path . $file;
                $request->file('docs7')->move($file_path, $file);
            }
            if($request->hasFile('docs8')) {
                $file = time() . '.' . $request->docs8->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs8'] = $file_path . $file;
                $request->file('docs8')->move($file_path, $file);
            }
            if($request->hasFile('docs9')) {
                $file = time() . '.' . $request->docs9->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs9'] = $file_path . $file;
                $request->file('docs9')->move($file_path, $file);
            }
            if($request->hasFile('docs10')) {
                $file = time() . '.' . $request->docs10->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs10'] = $file_path . $file;
                $request->file('docs10')->move($file_path, $file);
            }
            $inventory = Inventory::create($data);
            // // Log the inventory
            // $inventoryLog = new InventoryLog();
            // $inventoryLog->type = "Inflow";
            // $inventoryLog->quantity = $data['quantity'];
            // $inventoryLog->remark = "Inflow for " . $data['name'];
            // $inventory->inventory_log()->save($inventoryLog);
            // // log the stocks for each supplier
            // $stock = new Stock();
            // $stock->supplier_id = $data['supplier_id'];
            // $stock->quantity = $data['quantity'] ?? 1;
            // $stock->amount = $data['amount'];
            // $inventory->stocks()->save($stock);
            Session::flash('success', 'Equipment created successfully');
            return redirect()->route('store.list', ['type' => $request->type]);   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function edit (Request $request, $id) {
        $inventory = Inventory::find($id);
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        $suppliers = Supplier::orderBy('name', 'asc')->get(['id', 'name']);
        if (!$inventory) {
            abort(404);
        }
        return view('pages.store.edit', compact('branches', 'inventory', 'suppliers'));
    }

    public function update(Request $request) {
        $inventory = Inventory::find($request->id);
        if (!$inventory) {
            abort(404);
        }
        $data = array(
            'name' => $request->name,
            'amount' => $request->amount ?? 0.00,
            'plate_number' => $request->plate_number,
            'serial_number' => $request->serial_number,
            'docs1' => $request->docs1 ?? $inventory->docs1,
            'docs2' => $request->docs2 ?? $inventory->docs2,
            'docs3' => $request->docs3 ?? $inventory->docs3,
            'docs4' => $request->docs4 ?? $inventory->docs4,
            'docs5' => $request->docs5 ?? $inventory->docs5,
            'docs6' => $request->docs6 ?? $inventory->docs6,
            'docs7' => $request->docs7 ?? $inventory->docs7,
            'docs8' => $request->docs8 ?? $inventory->docs8,
            'docs9' => $request->docs9 ?? $inventory->docs9,
            'docs10' => $request->docs10 ?? $inventory->docs10,
            'branch_id' => $request->branch_id,
            'branch_id' => $request->branch_id,
            'note' => $request->note,
            'type' => $request->type,
        );
        if ($request->type == 'light') {
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'amount' => 'numeric',
                'note' => 'nullable',
                'branch_id' => 'required|integer'
            ]);
        } else {
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'plate_number' => 'required|string',
                'serial_number' => 'required|string',
                'amount' => 'nullable',
                'docs1' => 'nullable',
                'docs2' => 'nullable',
                'docs3' => 'nullable',
                'docs4' => 'nullable',
                'docs5' => 'nullable',
                'docs6' => 'nullable',
                'docs7' => 'nullable',
                'docs8' => 'nullable',
                'docs9' => 'nullable',
                'docs10' => 'nullable',
                'note' => 'nullable',
                'branch_id' => 'required|integer'
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if (\Auth::user()->branch_id !== NULL) {
            if (\Auth::user()->branch_id != $data['branch_id']) {
                return redirect()->back()->withErrors('Your permission doesn\'t permit you to create a project for this branch')->withInput();
            }
        }
        try {
            if($request->hasFile('docs1')) {
                $file = time() . '.' . $request->docs1->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs1'] = $file_path . $file;
                $request->file('docs1')->move($file_path, $file);
            }
            if($request->hasFile('docs2')) {
                $file = time() . '.' . $request->docs2->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs2'] = $file_path . $file;
                $request->file('docs2')->move($file_path, $file);
            }
            if($request->hasFile('docs3')) {
                $file = time() . '.' . $request->docs3->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs3'] = $file_path . $file;
                $request->file('docs3')->move($file_path, $file);
            }
            if($request->hasFile('docs4')) {
                $file = time() . '.' . $request->docs4->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs4'] = $file_path . $file;
                $request->file('docs4')->move($file_path, $file);
            }
            if($request->hasFile('docs5')) {
                $file = time() . '.' . $request->docs5->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs5'] = $file_path . $file;
                $request->file('docs5')->move($file_path, $file);
            }
            if($request->hasFile('docs6')) {
                $file = time() . '.' . $request->docs6->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs6'] = $file_path . $file;
                $request->file('docs6')->move($file_path, $file);
            }
            if($request->hasFile('docs7')) {
                $file = time() . '.' . $request->docs7->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs7'] = $file_path . $file;
                $request->file('docs7')->move($file_path, $file);
            }
            if($request->hasFile('docs8')) {
                $file = time() . '.' . $request->docs8->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs8'] = $file_path . $file;
                $request->file('docs8')->move($file_path, $file);
            }
            if($request->hasFile('docs9')) {
                $file = time() . '.' . $request->docs9->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs9'] = $file_path . $file;
                $request->file('docs9')->move($file_path, $file);
            }
            if($request->hasFile('docs10')) {
                $file = time() . '.' . $request->docs10->getClientOriginalExtension();
                $file_path = 'equipments/upload/';
                $data['docs10'] = $file_path . $file;
                $request->file('docs10')->move($file_path, $file);
            }
            $inventory->update($data);
            // $inventory->update(['quantity' => $inventory->quantity + $data['quantity']]);
            // // Log the inventory
            // $inventoryLog = new InventoryLog();
            // $inventoryLog->type = "Inflow";
            // $inventoryLog->quantity = $data['quantity'];
            // $inventoryLog->remark = "Inflow for " . $inventory->name;
            // $inventory->inventory_log()->save($inventoryLog);
            // // log the stocks for each supplier
            // $stock = new Stock();
            // $stock->supplier_id = $data['supplier_id'];
            // $stock->quantity = $data['quantity'];
            // $stock->amount = $data['amount'];
            // $inventory->stocks()->save($stock);
            Session::flash('success', 'Equipment created successfully');
            return redirect()->route('store.view', ['id' => $inventory->id]);   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function view (Request $request, $id) {
        $inventory = Inventory::find($id);
        if (!$inventory) {
            abort(404);
        }
        return view('pages.store.view', compact('inventory'));
    }

    public function destroy (Request $request, $id) {
        $inventory = Inventory::find($id);
        if (!$inventory) {
            abort(404);
        }
        $inventory->delete();
        $inventory->inventory_logs()->delete();
        $inventory->stocks()->delete();
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
