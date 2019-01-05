<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_email_for_type_in_table', function($attribute, $value, $parameters, $validator) {
            $table = $parameters[1];
            $userType = $parameters[0];
            $user = $value;
            $query = DB::table($table)->where('type', '=', $userType)->where('email', '=', $user)->first();
            if(is_null($query)){
                return true;
            }
            else {
                return false;
            }
        });

        Validator::extend('current_user_has_student', function($attribute, $value, $parameters, $validator) {
            $studentId = $value;
            $userId = Auth::user()->id;
            $user = User::find($userId);
            $students = $user->students;
            $student = $students->where('id', '=', $studentId)->first();
            if($student != null){
                return true;
            }
            else {
                return false;
            }
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UserStudentRelationships', 'App\Models\UserStudentRelationships');
    }
}
