<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                
                $user = Auth::user();
                
                if ($user->isUser()) {

                    session(['isUser' => true, 'isAdmin' => false]);
                    return redirect()->route('user.dashboard');
                }

                session(['isUser' => false, 'isAdmin' => true]);
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to authenticate user'])->withInput();
        }
    }


    public function logout()
    {
        try {

            Auth::logout();

            toastr()->success('Logout successfully!');
            return redirect()->route('login');
        } catch (\Exception $e) {
            toastr()->error('Oops! Failed to logout!', 'Oops!');
            return redirect()->back();
        }
    }
}
