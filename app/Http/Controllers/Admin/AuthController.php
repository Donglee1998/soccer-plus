<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show login form for admin
     *
     * @return \Illuminate\Http\Response
     */
    public function loginPage()
    {
        if (!Auth::guard('admin')->check()) {
            return view('admin.login');
        }
        return redirect()->route('admin.dashboard');
    }

    /**
     * Handle admin login
     *
     * @param AdminLoginRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        $remember = (isset($request->remember) && $request->remember == 'on') ? true : false;
        if (Auth::guard('admin')->attempt($login, $remember)) {
            if (!$remember) {
                change_expire_cookie_remember(120);
                $request->session()->regenerate();
            }
            if ($request->session()->has('admin_referer_url')) {
                return redirect($request->session()->get('admin_referer_url'));
            }
            return redirect(route('admin.dashboard'));
        } else {
            return redirect()->back()->withErrors(['status' => 'ログインIDもしくはパスワードが間違っています。'])
                ->withInput(['username' => $request->username]);
        }
    }

    /**
     * Handle admin logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
