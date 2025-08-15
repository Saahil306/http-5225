@extends('layouts/admin')
@section('content')
<div class="row mb-4">
    <div class="col d-flex justify-content-between align-items-center">
        <h1 class="display-4">{{ $course->name }}</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to Courses</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <p><strong>Description:</strong> {{ $course->description ?? 'No description provided' }}</p>
    </div>
</div>

<div class="row">
    <h3 class="mb-3">Enrolled Students</h3>
    @forelse($students as $student)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $student->fname }} {{ $student->lname }}</h5>
                    <p class="card-text">{{ $student->email }}</p>
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View Student</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <p class="text-muted">No students enrolled in this course.</p>
        </div>
    @endforelse
</div>
@endsection
