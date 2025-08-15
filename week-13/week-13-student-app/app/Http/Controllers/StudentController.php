<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            Student::create($request->validated());
            Session::flash('success', 'Student added successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error adding student: ' . $e->getMessage());
        }
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $student->update($request->validated());
            Session::flash('success', 'Student updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error updating student: ' . $e->getMessage());
        }
        return redirect()->route('students.index');
    }

    /**
     * Soft delete the specified student.
     */
    public function trash($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            Session::flash('success', 'Student trashed successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error trashing student: ' . $e->getMessage());
        }
        return redirect()->route('students.index');
    }

    /**
     * Permanently delete the specified student.
     */
    public function destroy($id)
    {
        try {
            $student = Student::withTrashed()->findOrFail($id);
            $student->forceDelete();
            Session::flash('success', 'Student deleted permanently');
        } catch (\Exception $e) {
            Session::flash('error', 'Error deleting student: ' . $e->getMessage());
        }
        return redirect()->route('students.index');
    }

    /**
     * Restore the specified soft-deleted student.
     */
    public function restore($id)
    {
        try {
            $student = Student::withTrashed()->findOrFail($id);
            $student->restore();
            Session::flash('success', 'Student restored successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error restoring student: ' . $e->getMessage());
        }
        return redirect()->route('students.trashed');
    }

    /**
     * Display all trashed students.
     */
    public function trashed()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.trashed', compact('students'));
    }
}
