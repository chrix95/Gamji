<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index (Request $request) {
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.branches.list', compact('branches'));
    }

    public function create (Request $request) {
        return view('pages.branches.create');
    }

    public function store (Request $request) {
        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'address' => $request->address
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'city' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }

        try {
            Branch::create($data);
            Session::flash('success', 'Branch created successfully');
            return redirect()->route('branches.list');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function edit (Request $request, $id) {
        $branch = Branch::find($id);
        if (!$branch) {
            abort(404);
        }
        return view('pages.branches.edit', compact('branch'));
    }

    public function update(Request $request) {
        $branch = Branch::find($request->id);
        if (!$branch) {
            abort(404);
        }
        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'address' => $request->address
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'city' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        $branch->update($data);
        return redirect()->route('branches.list');
    }

    public function destroy (Request $request, $id) {
        $branch = Branch::find($id);
        if (!$branch) {
            abort(404);
        }
        $branch->delete();
        return redirect()->back();
    }

}
