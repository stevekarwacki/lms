<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStudentRelationships extends Model
{
    protected $table = 'user_student_relationships';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'student_id',
    ];
}
