<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMentorRegistrationForm()
    {
        return view('auth.register.mentor');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showParentRegistrationForm()
    {
        return view('auth.register.parent');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mentorRegister(Request $request)
    {
        $request['type'] = "mentor";
        $this->userValidator($request->all())->validate();

        event(new Registered($user = $this->userCreate($request->all())));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function parentRegister(Request $request)
    {
        $request['type'] = "parent";
        $this->userValidator($request->all())->validate();

        event(new Registered($user = $this->userCreate($request->all())));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function userValidator(array $data)
    {
        $userType = $data['type'];
        $messages = array(
            'unique_email_for_type_in_table' => 'A ' . $userType . ' with that email address already exists.',
        );
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique_email_for_type_in_table:' . $userType . ',users',
            'password' => 'required|min:6|confirmed',
            ],
            $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function userCreate(array $data)
    {
        return User::create([
            'type' => $data['type'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
