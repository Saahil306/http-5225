<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'professor_id',
    ];

    /**
     * Many-to-Many relationship: A course can have multiple students
     */
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    /**
     * One-to-One relationship: A course has one professor
     */
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
}
