<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RequestID;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use MV\Notification\Mv;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index() {
        return view('home');
    }

    /**
     * Get user profile here
     * @return Factory|View
     */
    public function profile() {
        return view('user.account.profile');
    }

    /**
     * Credentials update
     * @return Factory|View
     */
    public function changePasswordPage() {
        return view('user.account.change_password');
    }

    /**
     * Credentials update
     * @param ChangePasswordRequest $request
     * @return Factory|View
     */
    public function changePassword(ChangePasswordRequest $request) {
        // Extract the request data.
        $password = $request->currentPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        // Get the current password
        $currentPassword = auth()->user()->password;
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
        $user = auth()->user();
        $user->password = bcrypt($newPassword);
        $user->update();

        Mv::createSystemNotification(null, auth()->id(), 'Password', 'You have successfully changed your password.');

        return redirect()->back()->with('success', 'You have successfully changed your password.');
    }

    /**
     * admin mails/notifications
     * @return Factory|View
     */
    public function latestMailBox() {
        return view('user.mailbox.latestMail', [
            'latestMails' => Mv::latestNotifications(),
        ]);
    }

    /**
     * read mail
     * @param string $notification_id
     * @return Factory|View
     */
    public function readMailBox(string $notification_id) {
        return view('user.mailbox.readMail', [
            'fetchMail' => Mv::readNotification($notification_id),
        ]);
    }

    /**
     * admin delete single mail
     * @param RequestID $request
     * @return RedirectResponse
     */
    public function deleteSingleMail(RequestID $request) {
        if (Mv::deleteSingleNotification($request->id))
            return redirect()->route('user.latest.mailbox')->with('success', 'Mail deleted successfully.');
        return redirect()->back()->with('error', 'Failed to delete notification.');
    }

    /**
     * fetch all notifications
     * @return Factory|View
     */
    public function allMailBox() {
        return view('user.mailbox.allMail', [
            'allMails' => Mv::allNotifications(),
        ]);
    }

    /**
     * delete all mails
     * @return RedirectResponse
     */
    public function deleteAllMails() {
        if (Mv::deleteAllNotifications())
            return redirect()->route('user.latest.mailbox')->with('success', 'Notification(s) deleted successfully.');
        return redirect()->route('user.latest.mailbox')->with('error', 'Failed to delete notification(s).');
    }


    /**
     * logout user
     * @return Factory|View
     */
    public function logout() {
        auth()->logout();
        session()->flush();
        return redirect()->route('login');
    }
}
