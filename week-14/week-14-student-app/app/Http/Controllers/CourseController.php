<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('students', 'professor')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professors = Professor::all(); // List of available professors
        $students = Student::all();     // List of students for many-to-many selection
        return view('courses.create', compact('professors', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            // Create course with professor assignment
            $courseData = $request->validated();
            $course = Course::create($courseData);

            // Attach selected students (many-to-many)
            if ($request->has('students')) {
                $course->students()->attach($request->students);
            }

            Session::flash('success', 'Course added successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error adding course: ' . $e->getMessage());
        }

        return redirect()->route('courses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::with('students')->findOrFail($id);
        $professors = Professor::all(); // Professors for selection
        $students = Student::all();     // Students for selection
        return view('courses.edit', compact('course', 'professors', 'students'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $courseData = $request->validated();
            $course->update($courseData);

            // Sync many-to-many students
            $course->students()->sync($request->students ?? []);

            Session::flash('success', 'Course updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error updating course: ' . $e->getMessage());
        }

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
            Session::flash('success', 'Course deleted successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Error deleting course: ' . $e->getMessage());
        }

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified course along with its students and professor.
     */
    public function show($id)
    {
        $course = Course::with(['professor', 'students'])->findOrFail($id);
        $students = $course->students; // all students enrolled in this course
        return view('courses.show', compact('course', 'students'));
    }
}
