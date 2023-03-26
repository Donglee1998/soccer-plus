<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Models\PasswordAccountReset;
use App\Repositories\RegistrationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\Auth\SendVerificationEmail;
use App\Http\Requests\Web\ForgotPasswordRequest;
use App\Http\Requests\Web\ResetPasswordRequest;
use App\Http\Requests\Web\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    protected $__registrationRepo;

    public function __construct(RegistrationRepository $registrationRepo)
    {
        $this->__registrationRepo = $registrationRepo;
    }

    /**
     * Show Login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('web.top');
        }

        return view('web.auth.login');
    }

    /**
     * Show Forgot password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgotPasswordForm()
    {
        return view('web.auth.forgot-password');
    }

    /**
     * Show Reset Password form.
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function showFormResetPassword ($token)
    {
        return view('web.auth.reset-password', compact('token'));
    }

    /**
     * Login for both article user and admin article user.
     *
     * @param Illuminate\Http\Request  $request;
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        try {
            $credential = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            $account = $this->__registrationRepo->getWebLogin($credential['username']);
            $remember   = (isset($request->remember) && $request->remember == 'on') ? true : false;
            $is_logged  = false;
            if ($account) {
                if (Auth::guard('web')->attempt($credential, $remember)) {
                    $is_logged = true;
                    if (!$remember) {
                        change_expire_cookie_remember(120);
                        $request->session()->regenerate();
                    }
                }
            }
            if ($is_logged) {
                return redirect()->route('web.scorebook.list')->with('loginSuccess', true);
            }

            return redirect()->back()->withErrors(['credentials_incorrect' => 'アカウントが存在しないか、契約の有効期限が切れています'])
                ->withInput(['username' => $request->username]);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $email    = $request->email;
            $account = $this->__registrationRepo->findByEmail($email);
            if (!$account) {
                return redirect()->back()->withErrors(['email' => trans('auth.email_not_exists')]);
            }

            $token = \Str::random(60);
            $password_reset = (new PasswordAccountReset)::insert([
                'email'      => $email,
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);
            $url = route('web.auth.showForm.resetPassword', ['token' => $token]);
            $account->notifyNow(new SendVerificationEmail($email, $url, $account->username));

            return redirect()->back()->with('send_mail_reset_pass_success', [
                'message' => trans('notifications.sent_token_reset_pwd_success'),
                'email'   => $email,
            ]);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Reset Password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $password = PasswordAccountReset::where('token', $request->_token_reset_pass)->first();
            if (
                ($password && Carbon::parse($password->created_at)->addMinutes(PasswordAccountReset::EXPIRE_TOKEN)->isPast())
                || !$password
            ) {
                return redirect()->back()->withInput()->withErrors(['token' => trans('auth.token_valid')]);
            }

            $account = $this->__registrationRepo->findByEmail($password->email);
            if ($account) {
                $data_update = [
                    'password' => \Hash::make($request->get('data')['password'])
                ];
                $account->update($data_update);
                $password->delete();

                return redirect()->route('web.auth.resetPassword.success')->with('reset_pass_success', trans('auth.reset_password_successfully'));
            }

            return redirect()->back()->withErrors(['account' => 'アカウントが存在しないか、契約の有効期限が切れています']);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Show layout reset password successful.
     */
    public function passwordResetSuccessful()
    {
        return view('web.auth.password-reset-successful');
    }

    /**
     * Logout.
     */
    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        return redirect()->route('web.auth.showForm.login');
    }
}
