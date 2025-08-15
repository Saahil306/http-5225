@extends('layouts/admin')
@section('content')
<div class="row mb-4">
    <div class="col d-flex justify-content-between align-items-center">
        <h1 class="display-4">All Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
    </div>
</div>

<div class="row">
    @foreach($courses as $course)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ Str::limit($course->description, 80, '...') }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
