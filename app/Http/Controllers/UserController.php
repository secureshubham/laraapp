<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userloginpage(){
        return view('userloginpage');
    }
    public function registerpage(){
        return view('registerpage');
    }
    public function dashboard(){
        return view('dashboard.dashboard');
    }
    public function newuserregister(Request $reg_user){
        // dd($reg_user->_token);
        $token = $reg_user->_token;
        $validatedData = $reg_user->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);
        $usercreated = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),

        ]);
        if($usercreated){
            return redirect()->route('userloginpage');
        }   
    }
    
    public function loginauth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $cred = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];
        

        // dd($credentials);
 
        if (Auth::attempt($cred)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}
