<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the view.
     */
    public function view()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('cms.login.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth()->user();
            $request->session()->regenerate();
            session()->flash('message', 'Successfully login as ' . $user->name);
            activity()
                ->causedBy($user)
                ->log('login');
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(): RedirectResponse
    {
        $user = Auth::user();
        Auth::logout();
        activity()
            ->causedBy($user)
            ->log('logout');
        session()->flash('message', 'Successfully logout from the system');
        return redirect()->route('login');
    }
}