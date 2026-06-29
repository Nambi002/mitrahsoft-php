<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function unverified()
    {
        $users = User::where('role', 'user')
                    ->where('is_verified', 0)
                    ->get();
        return view('admin.unverified', compact('users'));
    }

    public function verified()
    {
        $users = User::where('role', 'user')
                    ->where('is_verified', 1)
                    ->get();
        return view('admin.verified', compact('users'));
    }

    public function inactive()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.inactive', compact('users'));
    }


    public function approveUser($id)
    {
        $user = User::find($id);
        $user->is_verified = 1;
        $user->save();
        return back();
    }

    public function inactivateUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
   public function activateUserAjax(Request $request)
{
    
    $user = User::withTrashed()->findOrFail($request->id);

    $user->restore();

 
    $user->is_verified = 1;
    $user->save();

    return response()->json([
        'success' => true,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile
        ]
    ]);
}
}
