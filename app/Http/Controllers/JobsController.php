<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Job;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session("id"))
        {
            $jobsData = Job::orderBy("created_at", "DESC")->where("job_owner", session("id"))->get()->toArray();

            return view("pages.jobs.index", ["jobsData" => $jobsData]);
        }
        else
        {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!session("id"))
            return abort(404);
        else
            return view("pages.jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session("id"))
        {
            $request->validate([
                "title" => "required|min:5|max:30",
                "description" => "required|min:10|max:300",
                "minsalary" => "required|integer",
                "maxsalary" => "required|integer"
            ]);
    
            $job = new Job();
            $job->title = $request->input("title");
            $job->description = $request->input("description");
            $job->fulltime = $request->has("fulltime") ? $request->input("fulltime") : 0;
            $job->minimun_salary = $request->input("minsalary");
            $job->maximun_salary = $request->input("maxsalary");
            $job->applied_users_ids = '';
            $job->applied_users_names = '';
            $job->job_owner = session("id");
            $job->save();
    
            return redirect()->route("index");
        }
        else 
        {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
