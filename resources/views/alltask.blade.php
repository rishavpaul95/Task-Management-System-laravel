@extends('layouts.main')
@push('page-title')
    <title>All Tasks</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Tasks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">



                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section>
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        {{-- <a href="{{ url('/tasks/trash') }}" class="btn btn-danger">
                            Go to Trash
                        </a> --}}
                    </div>

                    <form action="{{ url('/alltask') }}" method="GET" class="form-inline">
                        <label for="categoryFilter" class="mr-2">Filter by Category:</label>
                        <select class="form-control" id="categoryFilter" name="categoryFilter"
                            onchange="this.form.submit()">
                            <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <table id="tasksTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Topic</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Assigned to</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ \Carbon\Carbon::parse($task->date)->format('d, M Y') }}</th>
                                        <td>{{ $task->topic }}</td>
                                        <td>
                                            @if ($task->taskimage)
                                                <img src="{{ asset('storage/' . $task->taskimage) }}" alt="Task Image"
                                                    class="img-thumbnail" style="max-width: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td>
                                            @if ($task->status == 'Completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif ($task->status == 'Active')
                                                <span class="badge badge-primary">Active</span>
                                            @elseif ($task->status == 'Inactive')
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                            {{ $users->where('id', $task->user_id)->first()->name }}


                                        </td>

                                        <td>
                                            @if ($currentUser && ($currentUser->isAdmin() || $currentUser->id == $task->user_id))
                                                <a href="{{ url('/admin/assigntask/delete') }}/{{ $task->id }}">
                                                    <button type="button" class="btn btn-danger">Delete</button>
                                                </a>

                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $task->id }}">
                                                    Edit
                                                </button>
                                            @endif
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
                                                            <form
                                                                action="{{ url('/admin/assigntask/edit') }}/{{ $task->id }}"
                                                                method="POST" enctype="multipart/form-data">
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
                                                                    <select name="category" id="category"
                                                                        class="form-control">
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}"
                                                                                {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                                                                {{ $category->category }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="taskimage">Upload Image:</label>
                                                                    <input type="file" class="form-control-file"
                                                                        id="taskimage" name="taskimage">
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </form>
                                                            {{-- End of modal content --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </section>
    </div>
@endsection
