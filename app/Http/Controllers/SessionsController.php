<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use Illuminate\Support\Facades\ThrottleAttemptsException;



class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please complete the captcha validation.',
            'g-recaptcha-response.captcha' => 'Captcha validation failed, please try again.',
        ]);

        unset($attributes['g-recaptcha-response']);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            if(auth()->user()->user_role == 4)
            return redirect('profile')->with(['success' => 'You are logged in.']);
        else{
            return redirect()->action([DashboardController::class, 'main'])->with(['success' => 'You are logged in.']);

        }

        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
