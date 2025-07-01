<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Models\UserAccess;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {
    /**
     * Index
     */
    public function index(){
        if(Auth::check()){
            return redirect()->route('user.dashboard');
        }
        return view('auth::auth.login');
    }

    /**
     * Store
     */
    public function store(LoginRequest $request){

        $credentials = $request->only('userId', 'password');
        $user = UserAccess::where('userId', $credentials['userId'])->first();

        if (! $user) {
            return back()->with('error', 'User not found.');
        }

        // Password Check
        if ($user->userPassword === $credentials['password']) {
            
            // Upgrade Password to Hash 
            // $user->update([
            //     'userPassword' => Hash::make($credentials['password']),
            // ]); 

            Auth::login($user);
            return redirect()->intended('/dashboard');
        }else{
            return redirect()->back()->with('error', 'Invalid Credentials');
        }

        
    }

    /**
     * Logout
     */
    public function logout(Request $request){
        Auth::logout(); // Logs out the current user

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token

        return redirect()->route('user.login')->with('success', 'You have been logged out.');
    }

    /**
     * dashboard
     */
    public function dashboard(){
        return view('auth::auth.dashboard');
    }
}
