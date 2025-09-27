@extends('layout')

@section('title', 'Edit Student Information')

@section('content')
<div class="container">
  <h2 class="mb-4">Edit Student</h2>

    <form action="{{ route('student.update', $index) }}" method="POST">
    @csrf
    <div class="mb-3">
      <label>Student ID</label>
      <input type="text" name="id" class="form-control" value="{{ $student['id'] }}" required>
    </div>
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ $student['name'] }}" required>
    </div>
    <div class="mb-3">
      <label>Course & Year</label>
      <input type="text" name="courseyear" class="form-control" value="{{ $student['courseyear'] }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('student.list') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection