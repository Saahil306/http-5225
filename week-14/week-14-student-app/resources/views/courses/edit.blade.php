@extends('layouts/admin')
@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="display-4">Edit Course</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Course Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" 
                       name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $course->name) }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" 
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Assign Professor --}}
            <div class="mb-3">
                <label for="professor_id" class="form-label">Assign Professor</label>
                <select name="professor_id" id="professor_id" class="form-select @error('professor_id') is-invalid @enderror">
                    <option value="">-- Select Professor --</option>
                    @foreach($professors as $professor)
                        <option value="{{ $professor->id }}" {{ old('professor_id', $course->professor_id) == $professor->id ? 'selected' : '' }}>
                            {{ $professor->fname }} {{ $professor->lname }}
                        </option>
                    @endforeach
                </select>
                @error('professor_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Buttons --}}
            <button type="submit" class="btn btn-primary">Update Course</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
