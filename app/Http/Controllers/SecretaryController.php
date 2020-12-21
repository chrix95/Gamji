<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use App\Letter;
use App\Minute;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SecretaryController extends Controller
{
    public function letterIndex (Request $request) {
        $letters = Letter::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $letters = $letters->where('branch_id', Auth::user()->branch_id);    
        }
        return view('pages.secretary.letterlist', compact('letters'));
    }

    public function letterCreate (Request $request) {
        $branches = Branch::all();
        return view('pages.secretary.lettercreate', compact('branches'));
    }
    
    public function letterStore (Request $request) {
        $data = array(
            'title' => $request->title,
            'file_url' => $request->file_url,
            'description' => $request->description,
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'sender_phone' => $request->sender_phone,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'file_url' => 'required|file|mimes:pdf,doc,docx,jpeg,png,jpg,ppt,pptx,xls,xlsx',
            'description' => 'required|string',
            'sender_name' => 'nullable|string',
            'sender_email' => 'nullable|string',
            'sender_phone' => 'nullable|numeric',
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
            if($request->hasFile('file_url')) {
                $file = Str::slug($data['title']) . time() . '.' . $request->file_url->getClientOriginalExtension();
                $file_path = 'letters/upload/';
                $data['file_url'] = $file_path . $file;
                $request->file('file_url')->move($file_path, $file);
            } else {
                return redirect()->back()->withErrors("Kindly upload a valid file")->withInput();
            }
            $letter = Letter::create($data);
            Session::flash('success', 'Letter uploaded successfully');
            return redirect()->route('secretary.letter.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function letterDestroy (Request $request, $id) {
        $letter = Letter::find($id);
        if (!$letter) {
            abort(404);
        }
        if(file_exists($letter->file_url)) {
            File::delete($letter->file_url);
        }
        @unlink($letter->file_url);
        $letter->delete();
        return redirect()->back();
    }

    public function minuteIndex (Request $request) {
        $minutes = Minute::orderBy('id', 'desc')->get();
        if (Auth::user()->branch_id !== NULL) {
            $minutes = $minutes->where('branch_id', Auth::user()->branch_id);
        }
        return view('pages.secretary.minutelist', compact('minutes'));
    }

    public function minuteCreate (Request $request) {
        $branches = Branch::all();
        return view('pages.secretary.minutecreate', compact('branches'));
    }

    public function minuteStore (Request $request) {
        $data = array(
            'title' => $request->title,
            'file_url' => $request->file_url,
            'content' => $request->content,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'file_url' => 'required|file|mimes:pdf,doc,docx,jpeg,png,jpg,ppt,pptx,xls,xlsx',
            'content' => 'required|string',
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
            if($request->hasFile('file_url')) {
                $file = time() . '.' . $request->file_url->getClientOriginalExtension();
                $file_path = 'minutes/upload/';
                $data['file_url'] = $file_path . $file;
                $request->file('file_url')->move($file_path, $file);
            } else {
                return redirect()->back()->withErrors("Kindly upload a valid file")->withInput();
            }
            Minute::create($data);
            Session::flash('success', 'Minute uploaded successfully');
            return redirect()->route('secretary.minute.list');   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function minuteEdit (Request $request, $id) {
        $minute = Minute::find($id);
        $branches = Branch::all();
        if (!$minute) {
            abort(404);
        }
        return view('pages.secretary.minuteedit', compact('branches', 'minute'));
    }

    public function minuteUpdate (Request $request) {
        $minute = Minute::find($request->id);
        if (!$minute) {
            abort(404);
        }
        $data = array(
            'title' => $request->title,
            'file_url' => $request->file_url,
            'content' => $request->content,
            'branch_id' => $request->branch_id
        );
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png,jpg,ppt,pptx,xls,xlsx',
            'content' => 'required|string',
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
            if($request->hasFile('file_url')) {
                $file = time() . '.' . $request->file_url->getClientOriginalExtension();
                $file_path = 'minutes/upload/';
                $data['file_url'] = $file_path . $file;
                $request->file('file_url')->move($file_path, $file);
                $minute->update($data);
            } else {
                $minute->update(Arr::except($data, ['file_url']));
            }
            Session::flash('success', 'Minute updated successfully');
            return redirect()->route('secretary.minute.view', ['id' => $minute->id]);   
        } catch (\Throwable $th) {
            \Log::info($th);
            return redirect()->back()->withErrors('Internal server error. Contact admin for support')->withInput();
        }
    }

    public function minuteView (Request $request, $id) {
        $minute = Minute::find($id);
        if (!$minute) {
            abort(404);
        }
        return view('pages.secretary.minuteview', compact('minute'));
    }

}
