<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = rand(100000, 999999);
        $user->otp = $otp;
       
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP via Mailtrap
      //  Mail::send('emails.forgot-otp', ['otp' => $otp], function($message) use ($user){
        //    $message->to($user->email);
        //    $message->subject('Your Password Reset OTP');
       // });

        return redirect()->route('reset.password')->with('email', $user->email)
                     ->with('success', 'OTP has been sent to your email.');
    }

   
    public function showResetForm(Request $request)
    {
        $email = session('email');
        return view('auth.reset-password', compact('email'));
    }

   
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp || Carbon::parse($user->otp_expires_at)->isPast()) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Password reset successfully! You can login now.');
    }
}