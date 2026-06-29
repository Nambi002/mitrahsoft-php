<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class PasswordController extends Controller
{
   
    public function edit()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('auth.change-password',compact('categories'));
    }
   
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->password = $request->new_password;
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }
}
