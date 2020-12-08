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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index (Request $request) {
        $inventory = Inventory::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $inventory = $inventory->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.store.list', compact('inventory'));
    }

    public function create (Request $request) {
        $suppliers = Supplier::orderBy('name', 'asc')->get(['id', 'name']);
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.store.create', compact('branches', 'suppliers'));
    }
    
    public function store (Request $request) {
        $data = array(
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'amount' => $request->amount,
            'supplier_id' => $request->supplier_id,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:inventories',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'supplier_id' => 'required|integer',
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
            $inventory = Inventory::create($data);
            // Log the inventory
            $inventoryLog = new InventoryLog();
            $inventoryLog->type = "Inflow";
            $inventoryLog->quantity = $data['quantity'];
            $inventoryLog->remark = "Inflow for " . $data['name'];
            $inventory->inventory_log()->save($inventoryLog);
            // log the stocks for each supplier
            $stock = new Stock();
            $stock->supplier_id = $data['supplier_id'];
            $stock->quantity = $data['quantity'];
            $stock->amount = $data['amount'];
            $inventory->stocks()->save($stock);
            Session::flash('success', 'Equipment created successfully');
            return redirect()->route('store.list');   
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
            'quantity' => $request->quantity,
            'description' => $request->description,
            'amount' => $request->amount,
            'supplier_id' => $request->supplier_id,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'supplier_id' => 'required|integer',
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
            $inventory->update(['quantity' => $inventory->quantity + $data['quantity']]);
            // Log the inventory
            $inventoryLog = new InventoryLog();
            $inventoryLog->type = "Inflow";
            $inventoryLog->quantity = $data['quantity'];
            $inventoryLog->remark = "Inflow for " . $inventory->name;
            $inventory->inventory_log()->save($inventoryLog);
            // log the stocks for each supplier
            $stock = new Stock();
            $stock->supplier_id = $data['supplier_id'];
            $stock->quantity = $data['quantity'];
            $stock->amount = $data['amount'];
            $inventory->stocks()->save($stock);
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
