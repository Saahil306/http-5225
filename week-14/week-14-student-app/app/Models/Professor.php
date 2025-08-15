<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    use HasFactory, SoftDeletes;

    // Fillable fields for mass assignment
    protected $fillable = [
        'fname',
        'lname',
        'email',
    ];

    /**
     * One-to-one relationship with Course
     * Each professor has one course.
     */
    public function course()
    {
        return $this->hasOne(Course::class);
    }
}
