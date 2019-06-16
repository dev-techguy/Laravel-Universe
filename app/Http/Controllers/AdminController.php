<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\MarksRequest;
use App\Http\Requests\RequestID;
use App\Program;
use App\SemesterOne;
use App\SemesterTwo;
use App\Unit;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use MV\Notification\Mv;

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
        return view('admin.home', [
            'users' => count(User::all()),
            'new' => count(User::query()->whereDate('created_at', today())->get()),
            'programs' => count(Program::all()),
            'units' => count(Unit::all()),
        ]);
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

        Mv::createSystemNotification(auth('admin')->id(), null, 'Password', 'You have successfully changed your password.');

        return redirect()->back()->with('success', 'You have successfully changed your password.');
    }

    /**
     * Admin view all students
     * @return Factory|View
     */
    public function viewAllStudents() {
        return view('admin.students.student', [
            'students' => User::query()->with('program')->paginate(config('mv-notification.paginate')),
        ]);
    }

    /**
     * Add semester one program
     * @return Factory|View
     */
    public function semesterOnePage() {
        return \view('admin.students.one-results', [
            'ones' => SemesterOne::query()->whereIn('user_id', User::query()->where('program_verified', true)->get())->paginate(config('mv-notification.paginate')),
        ]);
    }

    /**
     * Update marks here
     * @param MarksRequest $request
     * @return RedirectResponse
     */
    public function semesterOneMarks(MarksRequest $request) {
        $count = 0;
        foreach ($request->user_id as $user_id) {
            SemesterOne::query()->where('user_id', $user_id)->update([
                'catOne' => $request->catOne[$count],
                'catTwo' => $request->catTwo[$count],
                'mainExam' => $request->mainExam[$count],
                'average' => ($request->catOne[$count] + $request->catTwo[$count] + $request->mainExam[$count]),
            ]);

            //Increment
            $count++;
        }

        return redirect()->back()->with('success', 'Marks updated successfully');
    }

    /**
     * Add semester one program
     * @return Factory|View
     */
    public function semesterTwoPage() {
        return \view('admin.students.two-results', [
            'twos' => SemesterTwo::query()->whereIn('user_id', User::query()->where('program_verified', true)->get())->paginate(config('mv-notification.paginate')),
        ]);
    }

    /**
     * Update marks here
     * @param MarksRequest $request
     * @return RedirectResponse
     */
    public function semesterTwoMarks(MarksRequest $request) {
        $count = 0;
        foreach ($request->user_id as $user_id) {
            SemesterTwo::query()->where('user_id', $user_id)->update([
                'catOne' => $request->catOne[$count],
                'catTwo' => $request->catTwo[$count],
                'mainExam' => $request->mainExam[$count],
                'average' => ($request->catOne[$count] + $request->catTwo[$count] + $request->mainExam[$count]),
            ]);

            //Increment
            $count++;
        }

        return redirect()->back()->with('success', 'Marks updated successfully');
    }

    /**
     * Verify student
     * @param string $id
     * @return RedirectResponse
     */
    public function verify(string $id) {
        $student = User::query()->with('program')->findOrFail($id);
        $student->update([
            'program_verified' => true,
        ]);

        //create in semester one
        SemesterOne::query()->create([
            'unit_id' => $student->program->unit->where('semesterOne', true)->first()->id,
            'user_id' => $student->id,
        ]);

        //create in semester two
        SemesterTwo::query()->create([
            'unit_id' => $student->program->unit->where('semesterTwo', true)->first()->id,
            'user_id' => $student->id,
        ]);

        return redirect()->back()->with('success', $student->name . ' verified successfully.');
    }

    /**
     * view programs here
     * @return Factory|View
     */
    public function viewPrograms() {
        return \view('admin.uni.programs', [
            'programs' => Program::query()->with('unit', 'user')->inRandomOrder()->paginate(config('mv-notification.paginate')),
        ]);
    }

    /**
     * View all units
     * @return Factory|View
     */
    public function viewUnits() {
        return \view('admin.uni.units', [
            'units' => Unit::query()->with('program')->inRandomOrder()->paginate(config('mv-notification.paginate')),
        ]);
    }


    /**
     * admin mails/notifications
     * @return Factory|View
     */
    public function latestMailBox() {
        return view('admin.mailbox.latestMail', [
            'latestMails' => Mv::latestNotifications(true),
        ]);
    }

    /**
     * read mail
     * @param string $notification_id
     * @return Factory|View
     */
    public function readMailBox(string $notification_id) {
        return view('admin.mailbox.readMail', [
            'fetchMail' => Mv::readNotification($notification_id, true),
        ]);
    }

    /**
     * admin delete single mail
     * @param RequestID $request
     * @return RedirectResponse
     */
    public function deleteSingleMail(RequestID $request) {
        if (Mv::deleteSingleNotification($request->id, true))
            return redirect()->route('admin.latest.mailbox')->with('success', 'Mail deleted successfully.');
        return redirect()->back()->with('error', 'Failed to delete notification.');
    }

    /**
     * fetch all notifications
     * @return Factory|View
     */
    public function allMailBox() {
        return view('admin.mailbox.allMail', [
            'allMails' => Mv::allNotifications(true),
        ]);
    }

    /**
     * delete all mails
     * @return RedirectResponse
     */
    public function deleteAllMails() {
        if (Mv::deleteAllNotifications(true))
            return redirect()->route('admin.latest.mailbox')->with('success', 'Notification(s) deleted successfully.');
        return redirect()->route('admin.latest.mailbox')->with('error', 'Failed to delete notification(s).');
    }

    /**
     * logout admin
     * @return Factory|View
     */
    public function logout() {
        auth('admin')->logout();
        session()->flush();
        return redirect()->route('admin.login');
    }
}
