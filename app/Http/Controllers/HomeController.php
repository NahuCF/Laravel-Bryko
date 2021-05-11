<?php

namespace App\Http\Controllers;

// Controllers
use Illuminate\Http\Request;

//Models
use App\Models\User;
use App\Models\Job;

use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy("created_at", "DESC")->get();

        return view("pages.main", ["jobs", "jobs" => $jobs]);
    }

    public function login(Request $request)
    {
        $user = User::where(["username" => $request->input("username-login")])->first();

        if(!empty($user))
        {
            if(Hash::check($request->input("password-login"), $user->password))
            {
                session([
                    "id" => $user->id,
                    "username" => $user->username
                ]);
            }
        }

        return redirect()->route("index");
    }

    public function register(Request $request)
    {
        $request->validate([
            "username" => "required|min:5|max:15",
            "email" => "required|max:30|email:rfc,dns",
            "password" => "required|min:7|max:20",
            "cv" => "required"
        ]);

        $user = new User();
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->cv = $request->input("password");
        $user->save();

        $request->session()->flash("registered", "Successful registration, now you can Login");

        return redirect()->route("index");
    }
    
    public function logout()
    {
        session()->flush();

        return redirect()->route("index");
    }
}
