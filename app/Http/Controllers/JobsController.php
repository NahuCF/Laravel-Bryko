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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $request->validate([
            "title" => "required|min:5|max:30",
            "description" => "required|min:10|max:300",
            "minsalary" => "required|integer",
            "maxsalary" => "required|integer"
        ]);

        $user = new Job();
        $user->title = $request->input("title");
        $user->description = $request->input("description");
        $user->fulltime = $request->has("fulltime") ? $request->input("fulltime") : 0;
        $user->minimun_salary = $request->input("minsalary");
        $user->maximun_salary = $request->input("maxsalary");
        $user->applied_users = '';
        $user->save();

        return redirect()->route("index");
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
