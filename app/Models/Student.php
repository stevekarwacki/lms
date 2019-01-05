<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Student extends Model
{

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'dob', 'mentor_contact', 'email',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_student_relationships', 'student_id', 'user_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot() {
        parent::boot();
        static::created(function($student) {
            $student->buildRelationship();
        });
    }

    /**
     * Add an entry in user_student_relationships table
     *
     * @return void
     */
    public function buildRelationship() {
        $relationship = app('UserStudentRelationships');
        $relationship->user_id = Auth::user()->id;
        $relationship->student_id = $this->id;
        $relationship->save();
    }

}
