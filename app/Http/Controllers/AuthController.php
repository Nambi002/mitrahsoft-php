<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    
public function showLogin()
{
    return view('login');
}



public function showRegister()
{
    return view('register');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'mobile' => 'required',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'is_verified' => 0
    ]);

    return redirect('/login')->with('success', 'Registered! Wait for admin verify.');
}

public function login(Request $request)
{
    
    if (Auth::check()) {
        if (Auth::user()->role !== $request->role) {
            return back()->with('error', 'Please logout before switching role');
        }
    }

  
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Invalid user');
    }

    
    if ($user->role !== $request->role) {
        return back()->with('error', 'Invalid role selected');
    }

   
    if ($user->role == 'user' && !$user->is_verified) {
        return back()->with('error', 'User not approved by admin');
    }
   
      if (!Auth::validate(['email' => $request->email, 'password' => $request->password])) {
        return back()->with('error', 'Invalid password');
    }

     
    if ($user->role === 'admin') {
        Auth::login($user);
        $request->session()->regenerate();
        session(['role' => $user->role]);
        return redirect('/admin/dashboard');
    }

 
    $otp = rand(100000, 999999);

    $user->otp = $otp;
    $user->otp_expires_at = Carbon::now()->addMinute();
    $user->save();

    // Mail::to($user->email)->send(new SendOtpMail($otp));

    session(['otp_user_id' => $user->id]);

    return redirect('/otp');

    return back()->with('error', 'Invalid credentials');
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}


public function dashboard()
{
    return "dashboard";
}

public function showChangePassword()
{
    $user = User::find(Session::get('user_id'));
    return view('changepassword',compact('user'));
}

public function changePassword(Request $request)
{
 
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::find(Session::get('user_id'));

    if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password changed successfully.');
}

public function showOtp()
{
    return view('otp');
}
public function verifyOtp(Request $request)
{
    $user = User::find(session('otp_user_id'));

    if (!$user) {
        return redirect('/login')->with('error', 'Session expired');
    }

    if ($user->otp != $request->otp) {
        return back()->with('error', 'Invalid OTP');
    }

    if (Carbon::now()->gt($user->otp_expires_at)) {
        return back()->with('error', 'OTP expired');
    }

   
    Auth::login($user);

    session(['role' => $user->role]);

    
    $user->otp = null;
    $user->otp_expires_at = null;
    $user->save();

    session()->forget('otp_user_id');

    if ($user->role == 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/');
    }
}


public function resendOtp()
{
    $user = User::find(session('otp_user_id'));

    if (!$user) {
        return redirect('/login')->with('error', 'Session expired');
    }

    $otp = rand(100000, 999999);

    $user->otp = $otp;
    $user->otp_expires_at = Carbon::now()->addMinute();
    $user->save();

    //Mail::to($user->email)->send(new SendOtpMail($otp));

    return back()->with('success', 'OTP resent successfully');
}



}






