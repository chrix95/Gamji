<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use App\Permission;
use App\UserDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public $default_permission = ["project_view","project_create","project_edit","project_delete","project_add_milestone","project_expenses","store_view","store_create","store_edit","store_delete","store_request","store_approval","store_request_delete","supplier_view","supplier_create","supplier_edit","supplier_delete","employee_view","employee_create","employee_edit","employee_delete","progress_view","progress_create","progress_delete","letter_view","letter_create","letter_delete","minute_view","minute_edit","minute_create","minute_delete","notification_view","notification_edit","notification_create","notification_delete"];
    public function index (Request $request) {
        $users = User::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $users = $users->where('branch_id', Auth::user()->branch_id);
        }
        return view('pages.employee.list', compact('users'));
    }

    public function create (Request $request) {
        $branches = Branch::all();
        $permissions = Permission::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.employee.create', compact('branches', 'permissions'));
    }

    public function createdocs (Request $request, $employee_code) {
        return view('pages.employee.docs.create', compact('employee_code'));
    }
    
    public function store (Request $request) {
        $data = array(
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ?? NULL,
            'address' => $request->address,
            'position' => $request->position,
            'dob' => $request->dob,
            'password_confirmation' => $request->password_confirmation ?? NULL,
            'branch_id' => $request->branch_id,
            'guarantor_name' => $request->guarantor_name,
            'guarantor_phone' => $request->guarantor_phone,
            'guarantor_address' => $request->guarantor_address,
            'next_of_kin_name' => $request->next_of_kin_name,
            'next_of_kin_phone' => $request->next_of_kin_phone,
            'permission' => $request->permission ?? []
        );
        $validator = Validator::make($data, [
            'employee_code' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'nullable|min:6',
            'address' => 'required|string',
            'position' => 'required|string',
            'dob' => 'required|date',
            'branch_id' => 'required|nullable',
            'guarantor_name' => 'required|string',
            'guarantor_phone' => 'required|numeric',
            'guarantor_address' => 'required|string',
            'next_of_kin_name' => 'required|string',
            'next_of_kin_phone' => 'required|string',
            'permission' => 'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if (Auth::user()->branch_id === NULL) {
            if ($data['password'] != $data['password_confirmation']) {
                return redirect()->back()->withErrors('The password confirmation does not match.')->withInput();
            }
            $data['password'] = Hash::make($request->password);
        }
        // send an email to the user if requested
        if (\Auth::user()->branch_id !== NULL) {
            if (\Auth::user()->branch_id != $data['branch_id']) {
                return redirect()->back()->withErrors('Your permission doesn\'t permit you to create a project for this branch')->withInput();
            }
        }
        try {
            if($request->hasFile('means_of_identification')) {
                $file = Str::slug($data['guarantor_name']) . time() . '.' . $request->means_of_identification->getClientOriginalExtension();
                $file_path = 'idcards/upload/';
                $data['means_of_identification'] = $file_path . $file;
                $request->file('means_of_identification')->move($file_path, $file);
            } else {
                return redirect()->back()->withErrors("Kindly upload a valid means of Identification")->withInput();
            }
            if($request->hasFile('employment_letter')) {
                $file = Str::slug($data['name']) . time() . '.' . $request->employment_letter->getClientOriginalExtension();
                $file_path = 'employment_docs/upload/';
                $data['employment_letter'] = $file_path . $file;
                $request->file('employment_letter')->move($file_path, $file);
            } else {
                return redirect()->back()->withErrors("Kindly upload an employment letter")->withInput();
            }
            $user = User::create($data);
            Session::flash('success', 'User created successfully');
            return redirect()->route('employee.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function storedocs (Request $request, $employee_code) {
        $data = array(
            'title' => $request->title
        );
        $validator = Validator::make($data, [
            'title' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $user = User::where('employee_code', $employee_code)->first();
            if (!$user) {
                return redirect()->back()->withErrors("User information not found")->withInput();
            }
            if($request->hasFile('docs')) {
                $file = Str::slug($data['title']) . time() . '.' . $request->docs->getClientOriginalExtension();
                $file_path = 'employment_docs/upload/';
                $data['docs'] = $file_path . $file;
                $request->file('docs')->move($file_path, $file);
            } else {
                return redirect()->back()->withErrors("Kindly upload a valid document")->withInput();
            }
            $document = new UserDocument();
            $document->title = $data['title'];
            $document->docs = $data['docs'];
            $user->userDocument()->save($document);
            Session::flash('success', 'Document uploaded successfully');
            return redirect()->route('employee.view', ['employee_code' => $employee_code]);
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function edit (Request $request, $employee_code) {
        $user = User::where('employee_code', $employee_code)->first();
        $branches = Branch::all();
        $permissions = Permission::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        if (!$user) {
            abort(404);
        }
        return view('pages.employee.edit', compact('branches', 'user', 'permissions'));
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
            'branch_id' => $request->branch_id == 'NULL' ? NULL : $request->branch_id,
            'dob' => $request->dob,
            'position' => $request->position,
            'address' => $request->address,
            'guarantor_name' => $request->guarantor_name,
            'guarantor_phone' => $request->guarantor_phone,
            'guarantor_address' => $request->guarantor_address,
            'next_of_kin_name' => $request->next_of_kin_name,
            'next_of_kin_phone' => $request->next_of_kin_phone,
            'permission' => $request->permission
        );
        $validator = Validator::make($data, [
            'employee_code' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'branch_id' => 'nullable',
            'dob' => 'required|date',
            'address' => 'required|string',
            'position' => 'required|string',
            'guarantor_name' => 'required|string',
            'guarantor_phone' => 'required|numeric',
            'guarantor_address' => 'required|string',
            'next_of_kin_name' => 'required|string',
            'next_of_kin_phone' => 'required|string',
            'permission' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            if($request->hasFile('means_of_identification')) {
                $file = Str::slug($data['guarantor_name']) . time() . '.' . $request->means_of_identification->getClientOriginalExtension();
                $file_path = 'idcards/upload/';
                $data['means_of_identification'] = $file_path . $file;
                $request->file('means_of_identification')->move($file_path, $file);
            }
            if($request->hasFile('employment_letter')) {
                $file = Str::slug($data['name']) . time() . '.' . $request->employment_letter->getClientOriginalExtension();
                $file_path = 'employment_docs/upload/';
                $data['employment_letter'] = $file_path . $file;
                $request->file('employment_letter')->move($file_path, $file);
            }
            $user->update($data);
            return redirect()->route('employee.view', ['employee_code' => $user->employee_code]);
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function view (Request $request, $employee_code) {
        $user = User::where('employee_code', $employee_code)->first();
        $permissions = Permission::all();
        if (!$user) {
            abort(404);
        }
        return view('pages.employee.view', compact('user', 'permissions'));
    }

    public function destroy (Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        foreach ($user->userDocument as $value) {
            if(file_exists($value->docs)) {
                File::delete($value->docs);
            }
            @unlink($value->docs);
            $value->delete();
        }
        $user->delete();
        return redirect()->back();
    }

    public function destroydocs (Request $request, $id) {
        $document = UserDocument::find($id);
        if (!$document) {
            abort(404);
        }
        $document->delete();
        return redirect()->back();
    }

}
