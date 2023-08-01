<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Interested;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {

        $user = User::find(auth()->user()->id);

        return view('profile', [
            'users' => $user
        ]);



    }

    public function edit($id)
    {
        $this->middleware('auth');
        $id = auth()->user()->id;
        $user = User::where('id', $id)->get();

        return view('profileEdit', [
            'users' => $user[0]
        ]);
    }


    public function update(Request $request, User $user)
    {

        $id = auth()->user()->id;
        $user = User::where('id', $id)->get();

        $this->middleware('auth');~
        $rules = [
            'name' => 'required|max:255',
            'dob' => 'required',
            'photo' => 'image|max:2048',
            'gender' => 'required|in:0,1'
        ];

        if($request->email != $user[0]->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validatedData = $request->validate($rules);
        if($request->file('photo')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['photo'] = $request->file('photo')->store('profile-images', 'public');
        }

        $validatedData['id'] = auth()->user()->id;
        $user = User::where('id', $id);
        $user = $user->update($validatedData);

        return redirect('/profile')->with([
            'success' => 'Profile updated successfully',
            'error' => 'Check your profile again'
        ]);

    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/login')->with('success','Account has been deleted!');
    }


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function filterGender(Request $request)
    {
        $cityId = $request->input('city_id');
        $users = $cityId ? User::where('city_id', $cityId)->get() : User::all();

        return redirect('/home');
    }


    public function userIndex()
    {
        $userAuth = auth()->user();
        // $cities = City::all();
        // $city = request('city_id');
        $wallet = $userAuth->wallet;
        $males = User::where('gender', 'male')->get();
        $females = User::where('gender', 'female')->get();
        $users = User::where('gender', '!=', $userAuth->gender)->where('admin', '=', '0');
        $dislike = Interested::where('state_id', '!=', 5);

        // filter city
        // if ($city) {
        //     $users = $users->where('city_id', $city);
        // }

        $matches = Interested::where(function ($query) use ($userAuth) {
            $query->where('manid', $userAuth->id)
                ->orWhere('womanid', $userAuth->id);
        })->get();


        // filter final
        $users = $users->get();


        return view('home', compact('userAuth', 'wallet', 'cities', 'males', 'females', 'matches', 'users', 'city','dislike'));
    }

    public function banUser($id)
    {
        $userAuth = auth()->user();

        $user = User::where('admin', '!=', 1)->findOrFail($id);

        $user->state_id = 4;

        $user->save();

        return redirect()->back();
    }

    public function unbanUser($id)
    {
        $userAuth = auth()->user();

        $user = User::where('admin', '!=', 1)->findOrFail($id);

        $user->state_id = 1;

        $user->save();

        return redirect()->back();
    }

    public function adminIndex(){
        $userAuth = auth()->user();
        // $user = User::where('admin', '!=', 1)->where('state_id','!=', 4)->get();

        $user = User::where('admin', '!=', 1)->get();

        return view('homeAdmin', compact('userAuth', 'user'));
    }

    public function dislikeUser(Request $request)
    {
        if(auth()->user()->gender == "male"){
            Interested::create([
                'state_id' => '5',
                'manid' => auth()->user()->id,
                'womanid' => $request->loved_user_id,
                'liked' => $request->loved_user_id
            ]);
        } else{
            Interested::create([
                'state_id' => '5',
                'womanid' => auth()->user()->id,
                'manid' => $request->loved_user_id,
                'liked' => $request->loved_user_id
            ]);
        }
        return redirect()->back();
    }

    public function loveUser(Request $request)
    {
        if(auth()->user()->gender == "male"){
            Interested::create([
                'state_id' => '2',
                'manid' => auth()->user()->id,
                'womanid' => $request->loved_user_id,
                'liked' => $request->loved_user_id
            ]);
        } else{
            Interested::create([
                'state_id' => '2',
                'womanid' => auth()->user()->id,
                'manid' => $request->loved_user_id,
                'liked' => $request->loved_user_id
            ]);
        }
        // dd($request);
        //ngurangin duit
        // $user = User::find(auth()->user()->id);
        // $user->wallet = $user->wallet - 20;
        // $user->update();

        // if($request->loved_user_id){
        //     $match = Matched::findOrFail($request->loved_user_id);
        //     $match->state_id = '6';
        //     $match->update();
        //     return redirect()->back();
        // }

        return redirect()->back();
    }

    public function matcher(Request $request){
        // dd($request);
        $match = Interested::find($request->loved_user_id);
        $match->state_id = '3';
        $match->update();
        return redirect('/home');
    }

    // public function unmatch(Request $request)
    // {
    //     $match = Matched::findOrFail($request->loved_user_id);
    //     $match->state_id = '6';
    //     $match->update();
    //     return redirect('/home');
    // }


    // public function topup(Request $request)
    // {
    //     $user = User::find(auth()->user()->id);
    //     $user->wallet = $user->wallet + $request->wallet;
    //     $user->save();

    //     return redirect('/home');
    // }

    //function delete image
    public function deleteImg(User $user)
    {
        if ($user->photo) {
            // Hapus foto dari penyimpanan
            Storage::delete($user->photo);

            // Hapus referensi foto dari model pengguna
            $user->photo = null;
            $user->save();

            return redirect('/profile')->with('success', 'Photo has been deleted');
        } else {
            return redirect('/profile')->with('error', 'No photo to delete');
        }
    }
}
