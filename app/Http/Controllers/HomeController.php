<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestID;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
