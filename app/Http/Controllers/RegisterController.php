<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function index(){
        $jobs = Job::all();
        return view('register', compact('jobs'));
        // dd($cities);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:users',
            'linkedin' => 'required',
            'phoneNumber' => 'required|numeric',
            'photo' => 'image|max:2048',
            'password' => 'required',
            'job_id' => 'required|exists:jobs,id'
        ]);

        $validatedData['wallet'] = 0;
        if ($request->file('photo')->isValid()) {
            $validatedData['photo'] = $request->file('photo')->store('photo', 'public');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['admin'] = 0;
        $validatedData['state_id'] = 1;

        $randomPrice = rand(100000, 250000);

        User::create($validatedData);

        return redirect('/login')->with('registerSuccess', 'Registration Succes, Please Login!');

    }



    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // kalo betul ada credentialnya
        if(Auth::attempt($validate)){
            $request->session()->regenerate();

            $admin = auth()->user()->admin;
            $userbanned = auth()->user()->state_id;

            if($admin == 1){
                return redirect('/homeAdmin');
            }elseif($userbanned == 4){
                return redirect()->back()->with('loginError', "Login failed! You are banned");
            }else{
                return redirect('/home');
            }

        }

        return redirect()->back()->with('loginError', "Login failed!");
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');

    }
}
