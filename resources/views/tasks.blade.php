@extends('layouts.main')
@push('page-title')
    <title>Tasks</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tasks</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-9">

                        <a href="{{ url('/tasks/trash') }}"><button type="button" class="btn btn-danger">
                                Go to Trash
                            </button></a>


                    </div>
                    <div class="d-flex col-md-3 justify-content-center">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                            Add
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Add Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        {{-- modal content --}}
                                        <form action="{{ url('/') }}/tasks/add" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="date">Date:</label>
                                                <input type="date" class="form-control" id="date" name="date"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="topic">Topic:</label>
                                                <input type="text" class="form-control" id="topic" name="topic"
                                                    placeholder="Enter Topic" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status:</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category:</label>
                                                <select name="category" id="category" class="form-control">
<<<<<<< Updated upstream
                                                    @php
                                                        $categories = \App\Models\Categories::all();
                                                    @endphp
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}
                                                        </option>
=======
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
>>>>>>> Stashed changes
                                                    @endforeach
                                                </select>

                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            {{-- modal content --}}
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        {{-- table --}}

                        <table id="tasksTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Topic</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ \Carbon\Carbon::parse($task->date)->format('d, M Y') }}</th>
                                        <td>{{ $task->topic }}</td>
                                        <td>
                                            @if ($task->status == 'Completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif ($task->status == 'Active')
                                                <span class="badge badge-primary">Active</span>
                                            @elseif ($task->status == 'Inactive')
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td><a href= "{{ url('/tasks/delete') }}/{{ $task->id }}"><button type="button"
                                                    class="btn btn-danger">Delete</button></a>
                                            <!-- Edit Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $task->id }}">
                                                Edit
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $task->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $task->id }}">
                                                                Edit Task</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {{-- modal content --}}
                                                            <form action="{{ url('/tasks/edit') }}/{{ $task->id }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="date">Date:</label>
                                                                    <input type="date" class="form-control"
                                                                        id="date" name="date"
                                                                        value="{{ $task->date }}" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="topic">Topic:</label>
                                                                    <input type="text" class="form-control"
                                                                        id="topic" name="topic"
                                                                        value="{{ $task->topic }}"
                                                                        placeholder="Enter Topic" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="status">Status:</label>
                                                                    <select class="form-control" id="status"
                                                                        name="status" required>
                                                                        <option value="Completed"
                                                                            {{ $task->status == 'Completed' ? 'selected' : '' }}>
                                                                            Completed</option>
                                                                        <option value="Active"
                                                                            {{ $task->status == 'Active' ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="Inactive"
                                                                            {{ $task->status == 'Inactive' ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="category">Category:</label>
<<<<<<< Updated upstream
                                                                    <select name="category" id="category"
                                                                        class="form-control">

                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->category }}
                                                                            </option>
=======
                                                                    <select name="category" id="category" class="form-control">
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
>>>>>>> Stashed changes
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </form>
                                                            {{-- modal content --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- table end --}}

                    </div>
                </div>




            </div>
        </section>
    </div>
@endsection
