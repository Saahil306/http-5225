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
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{ route('students.trash', $student->id) }}" class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
