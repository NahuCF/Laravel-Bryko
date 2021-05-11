<?php

namespace App\Http\Controllers;

// Controllers
use Illuminate\Http\Request;

//Models

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.main');
    }

    public function login(Request $request)
    {
        dd($request);
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
}
