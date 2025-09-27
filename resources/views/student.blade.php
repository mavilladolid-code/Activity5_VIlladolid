@extends('layout')

@section('title', 'Student Information System')

@section('content')
  <div class="container">
    <h2 class="text-center mb-4">Student Information Form</h2>

    <!-- Input Form -->
    <div class="card p-4 shadow-sm mb-4">
      <form action="{{route('add.student')}}" method="POST">
        @csrf 
      <div class="row g-3">
        <div class="col-md-2">
          <input type="text" name="id" class="form-control" placeholder="Student ID" required>
        </div>
        <div class="col-md-6">
          <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="courseyear" class="form-control" placeholder="Course and Year" required>
        </div>
        <div class="col-md-1 d-grid">
          <button type = "submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
    </div>

    <!-- Search -->
    <div class="input-group mb-2">
    <form action="{{ route('student.list') }}" method="GET" class="d-flex w-100">
    <input type="text"
    id="searchBox"
    name="search"
    class="form-control"
    placeholder="Search by name"
    value="{{ request('search') }}"
    oninput="this.form.submit()"> {{-- auto-submit when typing --}}
    </form>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Student ID</th>
              <th>Name</th>
              <th>Course & Year</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($studentlist as $index => $student)
            <tr>
              <td>{{$student['id']}}</td>
              <td>{{$student['name']}}</td>
              <td>{{$student['courseyear']}}</td>
              <td>
              <!-- Edit button -->
              <a href="{{ route('student.edit', $index) }}" class="btn btn-warning btn-sm">Edit</a>
              <!-- Delete button -->
              <form action="{{ route('student.delete', $index) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
              </td>
            </tr>
            @endforeach
          </tbody> 
        </table>
      </div>
    </div>
  </div>

<script>
    const searchBox = document.getElementById("searchBox");
    searchBox.focus();
    searchBox.setSelectionRange(searchBox.value.length, searchBox.value.length);
</script>
@endsection
