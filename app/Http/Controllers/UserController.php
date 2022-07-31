<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function showRegister(){
        return view('register');
    }

    public function showProfile(){
        return view('profile');
    }

    public function login(Request $request, User $user){
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if(auth()->attempt($fields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You have successfully logged in.');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function register(Request $request, User $user){
        $fields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $fields['password'] = bcrypt($fields['password']);

        $newuser = $user->create($fields);
        auth()->login($newuser);

        return redirect('/')->with('message', 'You have successfully registered.');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have successfully logged out.');
    }


    public function updateProfile(Request $request, User $user){
        $fields = $request->validate([
            'name' => ['required', 'min:3'],
            'password' => ['nullable', 'confirmed', 'min:6']
        ]);

        if(!Hash::check($request->oldpassword, auth()->user()->password)) {
            return back()->with("message", "Old password does not match.");
        }

        $user->where('id', '=', auth()->user()->id)->update([
            'name' => $fields['name']
        ]);

        if($fields['password'] !== null && $fields['password'] !== ''){
            $user->where('id', '=', auth()->user()->id)->update([
                'password' => bcrypt($fields['password'])
            ]);
        }

        return back()->with('message', 'You have successfully changed your credentials.');
    }

    public function generateToken(User $user){

        $apiToken = Str::random(35);

        $user->where('id', '=', auth()->user()->id)->update([
            'API_token' => $apiToken
        ]);

        return back()->with('message', 'You have successfully generated new API token.');
    }
}
