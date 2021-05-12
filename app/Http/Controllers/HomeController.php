<?php

namespace App\Http\Controllers;

// Controllers
use Illuminate\Http\Request;

//Models
use App\Models\User;
use App\Models\Job;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Response;

class HomeController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy("created_at", "DESC")->get();

        return view("pages.main", ["jobs" => $jobs]);
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
        $user->cv = file_get_contents($request->file("cv"));
        $user->extension = $request->file("cv")->getClientOriginalExtension();
        $user->save();

        $request->session()->flash("registered", "Successful registration, now you can Log In");

        return redirect()->route("index");
    }
    
    public function logout()
    {
        session()->flush();

        return redirect()->route("index");
    }

    public function apply(Request $request)
    {
        if(session("id"))
        {
            $job = Job::select(["id", "applied_users_ids", "applied_users_names"])->where(["id" => $request->id])->get()->toArray()[0];
            
            // Add username and id to the job
            if(empty($job["applied_users_ids"]))
            {
                $idArray = json_encode([session("id")]);
                $usernameArray = json_encode([session("username")]);

                Job::where("id", $request->id)->update([
                    "applied_users_ids" => $idArray,
                    "applied_users_names" => $usernameArray
                ]);
            }
            else
            {
                $idsArray = json_decode($job["applied_users_ids"]);
                $usernameArray = json_decode($job["applied_users_names"]);
                
                // Only apply to this job if you did not
                if(!in_array(session("id"), $idsArray))
                {
                    array_push($idsArray, session("id"));
                    array_push($usernameArray, session("username"));

                    $encodeIds = json_encode($idsArray);
                    $encodeUsernames = json_encode($usernameArray);

                    Job::where("id", $request->id)->update([
                        "applied_users_ids" => $encodeIds,
                        "applied_users_names" => $encodeUsernames
                    ]);
                }
            }
        }

        return redirect()->route("index");
    }

    public function dowload(Request $request)
    {
        // Firt check if I am the owner of that job
        $job = Job::select(["job_owner", "applied_users_ids"])->where(["id" => $request->job_id])->get()->toArray()[0];

        $decode_usernames = json_decode($job["applied_users_ids"], true);

        // So that a stranger can download the cv he has 
        // to know the id of the owner of the job
        // and the id of the owner of the cv.

        if($job["job_owner"] == session("id") && in_array($job["job_owner"], $decode_usernames)) // It is my job and there is the user
        {
            $cv = User::where("id", $request->user_id)->get()->toArray()[0];

            header("Content-Disposition: attachment; filename=" . $cv["username"] . "." .$cv["extension"]); 
            echo $cv["cv"];
        }
        else
        {
            return abort(404);
        }
    }
}