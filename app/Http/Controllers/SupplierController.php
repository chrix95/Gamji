<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index (Request $request) {
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('pages.supplier.list', compact('suppliers'));
    }

    public function create (Request $request) {
        return view('pages.supplier.create');
    }
    
    public function store (Request $request) {
        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            Supplier::create($data);
            Session::flash('success', 'Supplier created successfully');
            return redirect()->route('supplier.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function edit (Request $request, $id) {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            abort(404);
        }
        return view('pages.supplier.edit', compact('supplier'));
    }

    public function update(Request $request) {
        $supplier = Supplier::find($request->id);
        if (!$supplier) {
            abort(404);
        }
        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        );
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|string',
            'address' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            $supplier->update($data);
            return redirect()->route('supplier.list');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function view (Request $request, $id) {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            abort(404);
        }
        return view('pages.supplier.view', compact('supplier'));
    }

    public function destroy (Request $request, $id) {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            abort(404);
        }
        $supplier->delete();
        return redirect()->back();
    }

}
