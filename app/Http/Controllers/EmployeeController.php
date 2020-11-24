<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index (Request $request) {
        $users = User::where('role', '0')->orderBy('id', 'desc')->get();
        return view('pages.employee.list', compact('users'));
    }

    public function create (Request $request) {
        $branches = Branch::all();
        return view('pages.employee.create', compact('branches'));
    }
    
    public function store (Request $request) {
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'address' => $request->address,
            'dob' => $request->dob,
            'employee_code' => $request->employee_code,
            'password_confirmation' => $request->password_confirmation,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:6',
            'address' => 'required|string',
            'dob' => 'required|date',
            'employee_code' => 'required|string',
            'branch_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if ($data['password'] != $data['password_confirmation']) {
            return redirect()->back()->withErrors('The password confirmation does not match.')->withInput();
        }
        $data['password'] = Hash::make($request->password);
        // send an email to the user if requested
        try {
            User::create($data);
            Session::flash('success', 'User created successfully');
            return redirect()->route('employee.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contat admin for support')->withInput();
        }
    }

    public function edit (Request $request, $employee_code) {
        $user = User::where('employee_code', $employee_code)->first();
        $branches = Branch::all();
        if (!$user) {
            abort(404);
        }
        return view('pages.employee.edit', compact('branches', 'user'));
    }

    public function update(Request $request) {
        $user = User::find($request->id);
        if (!$user) {
            abort(404);
        }
        $data = array(
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
            'dob' => $request->dob,
            'address' => $request->address,
        );
        $validator = Validator::make($data, [
            'employee_code' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'dob' => 'required|date',
            'address' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $user->update($data);
            return redirect()->route('employee.list');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contat admin for support')->withInput();
        }
    }

    public function view (Request $request, $employee_code) {
        $user = User::where('employee_code', $employee_code)->first();
        if (!$user) {
            abort(404);
        }
        return view('pages.employee.view', compact('user'));
    }

    public function destroy (Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $user->delete();
        return redirect()->back();
    }


}
