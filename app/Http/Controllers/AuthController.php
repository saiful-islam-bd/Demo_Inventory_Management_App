<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;
use App\Mail\ResetAdminPasswordMail;




class AuthController extends Controller
{
    // Show user login form
    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    public function showUserRegisterForm()
    {
        return view('auth.user-register');
    }

    // Show admin login form
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function showAdminRegisterForm()
    {
        return view('auth.admin-register');
    }


    // User login
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:2|max:12',
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }

    // Admin login
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:2|max:12',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }

    // User register
    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:2|max:12',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),

        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('dashboard');
    }

    // Admin register
    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins|max:255',
            'password' => 'required|min:2|max:12',
            'role_id' => 'required',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),

        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('dashboard');
    }


    // User dashboard
    public function userDashboard()
    {
        return view('auth.user-dashboard');
    }

    // Admin dashboard
    public function adminDashboard()
    {
        return view('auth.admin-dashboard');
    }


    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }


    // Handle forgot password request
    public function sendResetLink(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate token
        $token = Str::random(60);

        // Remove any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Insert new reset token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send reset link via email
        $resetLink = url('/password/reset/' . $token . '?email=' . $request->email);
        Mail::to($request->email)->send(new ResetPasswordMail($resetLink));

        return back()->with('success', 'Password Reset Link Sent to Your Email!');
    }


    // Show reset password form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }



    // Handle password reset
    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4|confirmed',
            'token' => 'required',
        ]);

        // Check token validity
        $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->where('email', $request->email)->first();

        if (!$tokenData) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // Reset password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete used token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return back()->with('success', 'Password Reset Successfully! Now Log in');

        // return redirect()->route('user.login')->with('success', 'Password reset successfully! Now Log in');
    }




     // Show admin forgot password form
     public function showAdminForgotPasswordForm()
     {
         return view('auth.admin-forgot-password-form');
     }


     // Handle admin forgot password request
    public function sendAdminResetLink(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ]);

        // Generate token
        $token = Str::random(60);

        // Remove any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Insert new reset token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send reset link via email
        $resetLink = url('/admin/password/reset/' . $token . '?email=' . $request->email);
        Mail::to($request->email)->send(new ResetAdminPasswordMail($resetLink));

        return back()->with('success', 'Password Reset Link Sent to Your Email!');
    }


    // Show admin reset password form
    public function showAdminResetForm($token)
    {
        return view('auth.admin-reset-password-form', ['token' => $token]);
    }
    


    // Handle password reset
    public function resetAdminPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:4|confirmed',
            'token' => 'required',
        ]);

        // Check token validity
        $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->where('email', $request->email)->first();

        if (!$tokenData) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // Reset password
        $user = Admin::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete used token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return back()->with('success', 'Password Reset Successfully! Now Log in');

        // return redirect()->route('user.login')->with('success', 'Password reset successfully! Now Log in');
    }




    // Logout for both user and admin, Logout for both guards  
    public function logout(Request $request)
    {
        $guard = Auth::guard('admin')->check() ? 'admin' : 'web';
        Auth::guard($guard)->logout();
        return redirect()->route($guard === 'admin' ? 'admin.login' : 'user.login');
    }



}
