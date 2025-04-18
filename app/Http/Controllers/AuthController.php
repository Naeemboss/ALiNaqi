<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt to log in using the credentials
        if (Auth::attempt($credentials)) {
            // If login is successful, redirect to the intended page (e.g., dashboard)
            return redirect()->route('dashboard');
        }

        // If login fails, redirect back with error message and old input
        return redirect()->route('login')
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();  // This keeps the old input (so users don't need to re-enter email)
    }

    // Show the dashboard page
    public function dashboardPage()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect()->route('login');
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}


