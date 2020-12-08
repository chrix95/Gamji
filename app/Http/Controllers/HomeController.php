<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $branches = Branch::all();
        $notification = Notification::latest()->first();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
            $notification = Notification::where('branch_id', Auth::user()->branch_id)->orWhere('branch_id', NULL)->orderBy('id', 'desc')->first();
        }
        return view('welcome', compact('branches', 'notification'));
    }
    
    public function select(Request $request, $branch_id) {
        $branch = Branch::find($branch_id);
        if(!$branch) {
            abort(404);
        }
        return view('branch_option', compact('branch'));
    }
    
    public function notificationList (Request $request)
    {
        $notifications = Notification::latest()->get();
        if (Auth::user()->branch_id !== NULL) {
            $notifications = Notification::where('branch_id', Auth::user()->branch_id)->orWhere('branch_id', NULL)->orderBy('id', 'desc')->get();
        }
        return view('pages.notification.list', compact('notifications'));
    }

    public function notificationCreate (Request $request) {
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.notification.create', compact('branches'));
    }
    
    public function notificationStore (Request $request) {
        $data = array(
            'title' => $request->title,
            'content' => $request->content,
            'expected_date' => $request->expected_date,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'content' => 'required|string',
            'expected_date' => 'nullable|date',
            'branch_id' => 'nullable'
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
            if ($request->branch_id == "NULL") {
                $data['branch_id'] = NULL;
            }
            Notification::create($data);
            Session::flash('success', 'Notification created successfully');
            return redirect()->route('notification.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function notificationEdit (Request $request, $id) {
        $notification = Notification::find($id);
        if (!$notification) {
            abort(404);
        }
        $branches = Branch::all();
        if (Auth::user()->branch_id !== NULL) {
            $branches = $branches->where('id', Auth::user()->branch_id);
        }
        return view('pages.notification.edit', compact('branches', 'notification'));
    }

    public function notificationUpdate(Request $request) {
        $notification = Notification::find($request->id);
        if (!$notification) {
            abort(404);
        }
        $data = array(
            'title' => $request->title,
            'content' => $request->content,
            'expected_date' => $request->expected_date,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'content' => 'required|string',
            'expected_date' => 'nullable|date',
            'branch_id' => 'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first())->withInput();
        }
        try {
            if ($request->branch_id == "NULL") {
                $data['branch_id'] = NULL;
            }
            $notification->update($data);
            return redirect()->route('notification.list');
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function notificationView (Request $request, $id) {
        $notification = Notification::find($id);
        if (!$notification) {
            abort(404);
        }
        return view('pages.notification.view', compact('notification'));
    }

    public function notificationDestroy (Request $request, $id) {
        $notification = Notification::find($id);
        if (!$notification) {
            abort(404);
        }
        $notification->delete();
        return redirect()->back();
    }

}
