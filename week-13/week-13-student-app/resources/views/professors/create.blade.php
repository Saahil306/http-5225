@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add Professor</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ implode(', ', $errors->all()) }}
        </div>
    @endif

    <form action="{{ route('professors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Professor Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('professors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
