@extends('layouts/admin')
@section('content')
<div class="row">
    <div class="col d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">Student Profile</h1>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $student->fname }} {{ $student->lname }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $student->email }}</p>
                <p class="card-text"><strong>Courses:</strong>
                    @forelse($student->courses as $course)
                        <span class="badge bg-primary">{{ $course->name }}</span>
                    @empty
                        <span class="text-muted">No courses assigned</span>
                    @endforelse
                </p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
