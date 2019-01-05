<?php

namespace App\Http\Controllers;

use App\Http\ViewComposers\MenuComposer;
use App\Models\Student;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    protected $menuComposer;
    protected $studentMayBeUpdated;

    public function __construct()
    {
        $this->middleware('auth');
        $this->studentMayBeUpdated = false;
        $this->menuComposer = new MenuComposer();
        $layout = 'layouts/2column';
        View::share('layout', $layout);
    }

    public function registeredStudents()
    {
        $user = Auth::user();
        $students = $user->students;
        $this->menuComposer->accountMenu($user);
        return view('student.list')->with(compact('students'));
    }

    public function showStudentRegistrationForm()
    {
        $user = Auth::user();
        $this->menuComposer->accountMenu($user);
        return view('student.register')->with(compact('user'));
    }

    public function studentRegister(Request $request)
    {
        $this->studentValidator($request->all())->validate();
        $this->studentCreate($request->all());
        return redirect('student/register');
    }

    public function studentUpdate($studentId, Request $request)
    {
        $request['id'] = $studentId;
        $this->studentUpdateValidator($request->all())->validate();
        if($this->studentMayBeUpdated) {
            $student = Student::find($studentId);
            $updatedStudent = array();
            $updatedStudent['id'] = $studentId;
            if ($request->name != '') $updatedStudent['name'] = $request->name;
            if ($request->dob != '') $updatedStudent['dob'] = $request->dob;
            if ($request->mentor_contact != '') $updatedStudent['mentor_contact'] = $request->mentor_contact;
            if ($request->email != '') $updatedStudent['email'] = $request->email;
            $student->update($updatedStudent);
        }
        return redirect('student/index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function studentValidator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'dob' => 'required|date|before:now',
            'mentor_contact' => 'required|boolean',
            'email' => 'email|max:255',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     */
    protected function studentUpdateValidator(array $data)
    {

        $messages = array(
            'current_user_has_student' => 'The student with an ID of "' . $data['id'] . '" does not belong to this parent account.',
        );
        $result = Validator::make($data, [
            'id' => 'required|integer|current_user_has_student',
            'name' => 'required|max:255',
            'dob' => 'required|date|before:now',
            'mentor_contact' => 'required|boolean',
            'email' => 'email|max:255',
        ],
            $messages);
        $this->studentMayBeUpdated = $result;
        return $result;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Student
     */
    protected function studentCreate(array $data)
    {
        return Student::create([
            'name' => $data['name'],
            'active' => 1,
            'dob' => date('Y-m-d', strtotime($data['dob'])),
            'mentor_contact' => $data['mentor_contact'],
            'email' => $data['email']
        ]);
    }

}
