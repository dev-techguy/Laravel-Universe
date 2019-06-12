<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SystemController;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class LoginController extends Controller {
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
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended($this->redirectTo);
        }
    }

    /**
     * Show the page for logging in the admin
     * @return Factory|View
     */
    public function getAdminLoginPage() {
        return view('auth.admin.login');
    }

    /**
     * Authenticate the system admin
     * @return RedirectResponse
     * @throws Exception
     */
    public function authenticateAdmin() {
        $this->validate(request(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Set the authentication credentials
        $credentials = request(['email', 'password']);

        // Try to authenticate the admin
        if (!auth()->guard('admin')->attempt($credentials)) {

            //log this
            SystemController::log($credentials, 'success', 'admin-login-error');

            return redirect()->back()->with('error', 'These credentials do not match our records.')->withInput(request()->except('password'));
        }

        //log this
        SystemController::log($credentials, 'success', 'admin-login');

        return redirect()->route('admin.home');
    }
}
