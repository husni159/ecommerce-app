<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AuthRepository;

use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    protected $authRepository;
    public function __construct(AuthRepository $autRepository)
    {
        $this->authRepository = $autRepository;
    }
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
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with('error', 'Invalid Details!!');
        }
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('products.index');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
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
            return redirect()->back()->with('error', 'Please verify details!!');
        }
        $this->authRepository->createUser($request);
        return redirect('/login')->with('success', 'Registration successful!'); // or redirect to a different page
     }
}
