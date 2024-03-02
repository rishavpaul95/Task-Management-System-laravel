@extends('layouts.main')

@push('page-title')
    <title>Assign Task</title>
@endpush

@section('main-section')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tasks Assigned By Me</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        {{-- <a href="{{ url('/tasks/trash') }}" class="btn btn-danger">
                            Go to Trash
                        </a> --}}
                    </div>

                    <form action="{{ url('/admin/assigntask') }}" method="GET" class="form-inline">
                        <label for="categoryFilter" class="mr-2">Filter by Project:</label>
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

                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        Assign Task
                    </button>


                    {{-- Add Modal Start --}}

                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Assign Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/admin/assigntask/add') }}" method="POST"
                                        enctype = 'multipart/form-data'>
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
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="taskimage">Upload Image:</label>
                                            <input type="file" class="form-control-file" id="addtaskimage"
                                                name="taskimage">
                                        </div>



                                        <div class="form-group">

                                            <label for="assigneduser">Assign To:</label>
                                            <select name="assigneduser" id="assigneduser" class="form-control">

                                                @foreach ($users as $user)
                                                    @if ($user->id != auth()->user()->id)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('assigneduser') == $user->id ? 'selected' : '' }}>
                                                            ID: {{ $user->id }} | {{ $user->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>


                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Add Modal End --}}

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
                                                <a class="fa-solid fa-trash-can"
                                                    href= "{{ url('/admin/assigntask/delete') }}/{{ $task->id }}"></a>
                                                <!-- Edit Button trigger modal -->

                                                &nbsp;&nbsp;

                                                <i class="fa-regular fa-pen-to-square" type="button"
                                                    class="fa-regular fa-pen-to-square" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $task->id }}">

                                                </i>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $task->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $task->id }}">Edit Task</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            @endif


                                            &nbsp;

                                            <a href="{{ url('/viewtask') }}/{{ $task->id }}" class="btn btn-outline-primary btn-sm">
                                                ({{ $task->comments->count() }})
                                                <i class="far fa-comments"></i>
                                                <span class="ms-1">View</span>
                                            </a>

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
