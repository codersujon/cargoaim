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

        $soft_cust_id = $user->soft_cust_id;
        $partition_id = $user->partition_id;
        
        $billing_id = $user->billing_id;
        $user_id = $user->userId;
        $password = $user->userPassword;
        $super_admin_type = $user->super_admin_type;
        $user_time_zone = $user->user_time_zone;
        $loginLiveMinute = $user->loginLiveMinute;
        $userCurrency = $user->userCurrency;
        $userCountry = $user->userCountry;

        if (! $user) {
            flasher_error('User not found.', [
                'timeout' => 3000,
                'position' => 'top-right',
            ]);
            return back();
        }

        // Password Check
        if ($user && $user->userPassword === $credentials['password']) {
            
            // Upgrade Password to Hash 
            // $user->update([
            //     'userPassword' => Hash::make($credentials['password']),
            // ]); 

            Auth::login($user);
            // Flash message for successful login
            flasher_success('Logged in successfully!', [
                'timeout' => 3000,
                'position' => 'top-right',
            ]);
            return redirect()->intended('/dashboard');

        }else{
            flasher_error('Invalid credentials', [
                'timeout' => 3000,
                'position' => 'top-right',
            ]);
            return redirect()->back();
        }

        
    }

    /**
     * Logout
     */
    public function logout(Request $request){
        Auth::logout(); // Logs out the current user

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token
        
        // Flash message for logout success
        flasher_success('User Logout Successfully!', [
            'timeout' => 3000,
            'position' => 'bottom-right',
        ]);
        return redirect()->route('user.login');
    }

    /**
     * dashboard
     */
    public function dashboard(){
        return view('auth::auth.dashboard');
    }
}
