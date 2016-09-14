<?php

namespace App\Http\Controllers\studentAuth;

use App\Student;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class StudentAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/student/login';

    protected $guard = 'student';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // code before multiAuth
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:students',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    // code before multiAuth

    protected function create(array $data)
    {
        return Student::create([
            'name' => $data['name'],
            'student_no' => $data['student_no'],
            'email' => $data['email'],            
            'password' => bcrypt($data['password']),            
        ]);
    }

    public function showLoginForm()
    {
        if (view()->exists('auth.authenticate'))
        {
            return view('auth.dashboard');
        }

        return view('student.login');
    }

    public function login(AuthenticateStudents $request)
    {
        dd($request->student_no);
    }

    public function showRegistrationForm()
    {
        return view('student.register');
    }  
}
