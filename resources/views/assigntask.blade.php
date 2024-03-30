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

                    <form action="{{ url('/assigntask') }}" method="GET" class="form-inline">
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

                    @can('assign_task')
                        @include('modals.assigntasks.assigntask')
                    @endcan

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table id="assigntasksTable" class="table">
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

                                            @can('delete_assigned_task')
                                                <a class="fa-solid fa-trash-can"
                                                    href= "{{ url('/assigntask/delete') }}/{{ $task->id }}"></a>
                                            @endcan

                                            &nbsp;&nbsp;

                                            @can('edit_assigned_task')
                                                @include('modals.assigntasks.editmodal')
                                            @endcan


                                            &nbsp;

                                            <a href="{{ url('/viewtask') }}/{{ $task->id }}?source=assigntaskpage"
                                                class="btn btn-outline-primary btn-sm">
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

        @push('scripts')
            <script>
                @if (session('success'))
                    toastr.success('{{ session('success') }}', 'Success');
                @endif

                @if (session('error'))
                    toastr.error('{{ session('error') }}', 'Error');
                @endif
            </script>
        @endpush
    </div>
@endsection
