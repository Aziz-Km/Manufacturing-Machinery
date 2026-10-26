<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Engineer;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the login username to be used by the controller.
     */
    public function username()
    {
        return request()->has('email') && !request()->has('login') ? 'email' : 'login';
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request)
    {
        $field = $this->username();
        $request->validate([
            $field => 'required|string',
            'password' => 'required|string',
        ], [
            "{$field}.required" => 'يرجى إدخال الرقم الوظيفي أو البريد الإلكتروني أو اسم المستخدم.',
            'password.required' => 'يرجى إدخال كلمة المرور.',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     * Allows logging in by email, employee ID (الرقم الوظيفي), or username.
     */
    protected function credentials(Request $request)
    {
        $login = trim($request->input('login', $request->input('email', '')));
        $password = $request->input('password');

        // Auto-fix inverted email format caused by BiDi / RTL typing (e.g. jowfe.com@2830 -> 2830@jowfe.com)
        if (preg_match('/^([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})@([a-zA-Z0-9._-]+)$/', $login, $m)) {
            $login = $m[2] . '@' . $m[1];
        }

        // 1. Valid email format check
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $login, 'password' => $password];
        }

        // 2. Engineer employee_id check (الرقم الوظيفي للمهندس)
        $engineer = Engineer::where('employee_id', $login)->with('user')->first();
        if ($engineer && $engineer->user) {
            return ['email' => $engineer->user->email, 'password' => $password];
        }

        // 3. User name match (اسم المستخدم)
        $user = User::where('name', $login)->first();
        if ($user) {
            return ['email' => $user->email, 'password' => $password];
        }

        // 4. Tolerant Arabic name match (e.g. عبدالعزبز / عبدالعزيز)
        $tolerantName = str_replace(['عبدالعزيز', 'عبدالعزبز'], 'عبدالعز%', $login);
        $userTolerant = User::where('name', 'like', $tolerantName)->first();
        if ($userTolerant) {
            return ['email' => $userTolerant->email, 'password' => $password];
        }

        // 5. Match by email prefix (e.g. 2830 for 2830@jowfe.com)
        $userByPrefix = User::where('email', 'like', $login . '@%')->first();
        if ($userByPrefix) {
            return ['email' => $userByPrefix->email, 'password' => $password];
        }

        return ['email' => $login, 'password' => $password];
    }

    /**
     * Get the failed login response instance.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $field = $this->username();
        throw ValidationException::withMessages([
            $field => ['بيانات الاعتماد المدخلة غير صحيحة، يرجى التأكد من صحة الرقم الوظيفي أو البريد وكلمة المرور.'],
        ]);
    }
}
