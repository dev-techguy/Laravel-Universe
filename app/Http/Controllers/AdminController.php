<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * get admin dashboard
     * @return Factory|View
     */
    public function adminDashBoard() {
        return view('admin.home');
    }


    /**
     * get admin profile
     * @return Factory|View
     */
    public function adminProfile() {
        return view('admin.account.profile');
    }

    /**
     * get the change password page
     * @return Factory|View
     */
    public function passwordPage() {
        return view('admin.account.change_password');
    }

    /**
     * change admin password here
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function changePassword(ChangePasswordRequest $request) {
        // Extract the request data.
        $password = $request->currentPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        // Get the current password
        $currentPassword = auth('admin')->user()->password;
        // Check if current password matches the sent password.
        if (!Hash::check($password, $currentPassword)) {
            return redirect()->back()->with('error', 'The entered password does not match our records.');
        }
        // Check if new password matches current password.
        if (strcmp($newPassword, $password) === 0) {
            return redirect()->back()->with('error', 'New password cannot be same as your current password.');
        }
        // Check if the new password matches the confirmation password.
        if (strcmp($newPassword, $confirmPassword) !== 0) {
            return redirect()->back()->with('error', 'The confirmation password does not match.');
        }

        // Get the current auth user and update their password.
        $user = auth('admin')->user();
        $user->password = bcrypt($newPassword);
        $user->update();

        //log this session
        SystemController::log(
            [
                'admin-name' => auth('admin')->user()->name,
                'description' => 'password changing',
            ]
            , 'success', 'admin-password-change');

        return redirect()->back()->with('success', 'You have successfully changed your password.');
    }

    /**
     * logout admin
     * @return Factory|View
     */
    public function logout() {
        auth('admin')->logout();
        session()->flush();
        return view('auth.admin.login');
    }
}
