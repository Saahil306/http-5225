{{-- resources/views/professors/index.blade.php --}}
@extends('layouts/admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Professors List</h2>
        <a href="{{ route('professors.create') }}" class="btn btn-primary">Add New Professor</a>
    </div>

    {{-- Success message --}}
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    {{-- Error message --}}
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    @if($professors->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($professors as $professor)
                <tr>
                    <td>{{ $professor->id }}</td>
                    <td>{{ $professor->fname }}</td>
                    <td>{{ $professor->lname }}</td>
                    <td>{{ $professor->email }}</td>
                    <td>{{ $professor->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('professors.edit', $professor->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('professors.destroy', $professor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this professor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            No professors found. Please add some.
        </div>
    @endif
</div>
@endsection
