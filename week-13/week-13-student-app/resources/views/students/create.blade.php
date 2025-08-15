@extends('layouts/admin')
@section('content')
<div class="row">
    <div class="col">
        <h1 class="display-2">Add a Student Profile</h1>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <form action="{{ route('students.store') }}" method="post">
            @csrf

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- First Name --}}
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" 
                       name="fname" 
                       id="fname"
                       class="form-control @error('fname') is-invalid @enderror" 
                       placeholder="First Name" 
                       value="{{ old('fname') }}">
                @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Last Name --}}
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" 
                       name="lname" 
                       id="lname"
                       class="form-control @error('lname') is-invalid @enderror" 
                       placeholder="Last Name" 
                       value="{{ old('lname') }}">
                @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       name="email" 
                       id="email"
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Email" 
                       value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
