<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class SettingsController extends Controller
{
    public function passwordView (Request $request) {
        return view('pages.settings.password');
    }

    public function changePassword(Request $request) {
        $user = User::find(Auth::id());
        if (!$user) {
            abort(404);
        }
        $data = array(
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        );
        $validator = Validator::make($data, [
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        if ($data['password'] != $data['password_confirmation']) {
            return redirect()->back()->withErrors('The password confirmation does not match.')->withInput();
        }
        try {
            $user->update(['password' => Hash::make($request->password)]);
            Session::flash('success', 'Password changed successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

}
