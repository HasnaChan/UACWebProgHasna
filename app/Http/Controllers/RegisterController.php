<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
        // $cities = City::all();
        return view('register');
        // dd($cities);
    }
    public function store(Request $request){ //setiap nembak data request harus kasih ini
        $validate = $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:users',
            // 'phoneNumber' => 'required|numeric',
            'photo' => 'required|image|max:2048',
            'password' => 'required',
            'city_id' => 'required|exists:cities,id'

        ]);
        $validate['wallet'] = 0;

        if ($request->file('photo')->isValid()) {
            $validate['photo'] = $request->file('photo')->store('photo', 'public');
        }
        // if ($validate['gender'] == 'male'){
        //     $gender = "01";
        // } else{
        //     $gender = "02";
        // }

        // $validate['generatedId'] = 'SKY'.$validate['datingCode'].$gender;
        // $validate['datingCode'] = 'DT'.$validate['datingCode'];
        // $validate['phoneNumber'] = '+65'.$validate['phoneNumber'];

        $validate['password'] = bcrypt($validate['password']);

        // $validate['admin'] = 0;
        $validate['state_id'] = 1;

        User::create($validate);

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
