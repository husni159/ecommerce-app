<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('products.index');
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function authPage(){
    
        // Check if the user is logged in
        if (Auth::check()) {
            // User is logged in
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isCustomer() || $user->isEmployee()) {
                return redirect()->route('products.index');
            }
            // Perform actions for logged-in user
        } else {
            // User is not logged in
            // Perform actions for non-logged-in user
            return view('auth.login');
        }
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    
     public function register(Request $request)
     {
        $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
             'type' => ['required', Rule::in(['employee', 'customer'])],
         ]);
         if ($validator->fails()) {
            
            return redirect()->back()->with('error', 'Invalid Details!!');
        }
        User::create([
             'name' => $request->input('name'),
             'email' => $request->input('email'),
             'password' => Hash::make($request->input('password')),
             'type' => $request->input('type'),
         ]);
  
         return redirect('/login')->with('success', 'Registration successful!'); // or redirect to a different page
     }
}
