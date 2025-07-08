<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\PostedJob as Job;
use Illuminate\Http\Request;
use Validator;
use Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('job')->get();
        if(auth()->user()->role_id == 2){
            $applications = Application::whereHas('job', function ($query) {
                $query->where('employer_id', auth()->id());
            })->with(['job'])->latest()->get();
        } 

        return view('admin.totalApplication', compact('applications'));
    }

    public function store(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'cover_letter' => 'nullable|string',
            'resume_path' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorList = '<ul>';
            $errorList .= '<b>Note: All Star <span style="color:red">(*)</span> mark is Required !</b>';
            foreach ($errors->all() as $error) {
                $errorList .= '<li>' . $error . '</li>';
            }
            $errorList .= '</ul>';
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('flash_message', $errorList)
                ->with('status_color', 'warning');
        }

        $resumePath = $request->file('resume_path')->store('resumes', 'public');

        auth()->user()->applications()->create([
            'job_id' => $job->id,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
            'status' => 1,
        ]);

        Session::flash('flash_message','Application submitted successfully!');
        return redirect()->back()->with('status_color','success');
    }
}
