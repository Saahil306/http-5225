<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of students with their courses.
     */
    public function index()
    {
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $courses = Course::all(); // Get all available courses
        return view('students.create', compact('courses'));
    }

    /**
     * Store a newly created student with selected courses.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $student = Student::create($request->validated());

            // Attach selected courses if any
            if ($request->has('courses')) {
                $student->courses()->attach($request->courses);
            }

            Session::flash('success', 'Student added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error adding student: ' . $e->getMessage());
        }

        return redirect()->route('students.index');
    }

    /**
     * Show the form for editing the student.
     */
    public function edit(Student $student)
    {
        $courses = Course::all(); // Get all courses for selection
        $student->load('courses'); // Load current student courses
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the student and sync selected courses.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $student->update($request->validated());

            // Sync selected courses
            $student->courses()->sync($request->courses ?? []);

            Session::flash('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error updating student: ' . $e->getMessage());
        }

        return redirect()->route('students.index');
    }

    /**
     * Soft delete a student.
     */
    public function trash($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            Session::flash('success', 'Student trashed successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error trashing student: ' . $e->getMessage());
        }

        return redirect()->route('students.index');
    }

    /**
     * Permanently delete a student.
     */
    public function destroy($id)
    {
        try {
            $student = Student::withTrashed()->findOrFail($id);
            $student->forceDelete();
            Session::flash('success', 'Student deleted permanently.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error deleting student: ' . $e->getMessage());
        }

        return redirect()->route('students.index');
    }

    /**
     * Restore a soft-deleted student.
     */
    public function restore($id)
    {
        try {
            $student = Student::withTrashed()->findOrFail($id);
            $student->restore();
            Session::flash('success', 'Student restored successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error restoring student: ' . $e->getMessage());
        }

        return redirect()->route('students.trashed');
    }

    /**
     * Display all soft-deleted students with their courses.
     */
    public function trashed()
    {
        $students = Student::onlyTrashed()->with('courses')->get();
        return view('students.trashed', compact('students'));
    }

     /**
     * Display a single student profile.
     */
    public function show($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        return view('students.show', compact('student'));
    }
}
