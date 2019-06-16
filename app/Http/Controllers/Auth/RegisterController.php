<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SystemController;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use MV\Notification\Mv;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'program_id' => ['required'],
            'county_id' => ['required'],
            'age' => ['required', 'numeric', 'max:40', 'min:16'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => ['required', 'numeric', 'digits_between:10,10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return Builder|Model
     * @throws Exception
     */
    protected function create(array $data) {
        $user = User::query()->create([
            'name' => $data['name'],
            'program_id' => $data['program_id'],
            'county_id' => $data['county_id'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'registrationNumber' => SystemController::generateStudentReg(),
            'phoneNumber' => $data['phoneNumber'],
            'password' => Hash::make($data['password']),
        ]);

        //create system notification here
        Mv::createSystemNotification(null, $user->id, 'Course Application', 'Hello ' . $user->name . ' we are glad that you have joined as we promise you gonna learn more on laravel. Please be patient as we verify your application.');
        Mv::createSystemNotification(1, null, 'New Application', 'Please verify a new registration with reg-number ' . $user->registrationNumber);

        return $user;
    }
}
