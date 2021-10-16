<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function changePasswordForm(Request $request)
    {
        return view('auth.change-password', compact('request'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required'
            ],
            'password' => [
                'required',
                'confirmed'
            ]
        ]);

        if (!Hash::check($request->get('current_password'), Auth::user()->password)) {
            return back()->with('error', 'Current password didn\'t match.');
        }

        Auth::user()->password = Hash::make($request->get('password'));
        Auth::user()->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
