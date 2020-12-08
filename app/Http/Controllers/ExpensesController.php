<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Expense;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    public function index (Request $request) {
        $inventory = Inventory::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $inventory = $inventory->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.store.list', compact('inventory'));
    }

    public function create (Request $request) {
        $projects = Project::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $projects = $projects->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.project.expenses.new', compact('projects'));
    }
    public function add (Request $request, $id) {
        $project = Project::find($id);
        if (!$project) {
            abort(404);
        }
        return view('pages.project.expenses.create', compact('project'));
    }
    
    public function store (Request $request) {
        $data = array(
            'amount' => $request->amount,
            'remark' => $request->remark,
            'project_id' => $request->project_id
        );
        $validator = Validator::make($data, [
            'amount' => 'required|numeric',
            'remark' => 'required|string',
            'project_id' => 'required|integer'
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
            $project = Project::find($data['project_id']);
            if (!$project) {
                abort(404);
            }
            $expense = new Expense();
            $expense->amount = $data['amount'];
            $expense->remark = $data['remark'];
            $project->expenses()->save($expense);
            Session::flash('success', 'Expense created successfully');
            return redirect()->route('project.view', ['project_code' => $project->project_code]);
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

}
