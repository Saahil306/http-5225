@extends('layouts/admin')
@section('content')
<div class="row">
    <div class="col d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">All Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-success">Add Student</a>
    </div>
</div>

<div class="row">
    @forelse($students as $student)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $student->fname }} {{ $student->lname }}</h5>
                    <p class="card-text">{{ $student->email }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('students.trash', $student->id) }}" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <div class="alert alert-info">No students found. <a href="{{ route('students.create') }}">Add a new student</a>.</div>
        </div>
    @endforelse
</div>
@endsection
