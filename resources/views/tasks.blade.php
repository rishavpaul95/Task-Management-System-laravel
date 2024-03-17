@extends('layouts.main')

@push('page-title')
    <title>Tasks</title>
@endpush

@section('main-section')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tasks</h1>
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


                </div>

                <div class="d-flex justify-content-end mb-3">
                    @can('add_own_task')
                        @include('modals.tasks.add')
                    @endcan
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
                                            @if ($task->assigned_by == $task->user_id)
                                                @can('edit_own_task')
                                                    @include('modals.tasks.edit')
                                                @endcan
                                            @elseif ($task->assigned_by != $task->user_id)
                                                @can('edit_own_assigned_task')
                                                    @include('modals.tasks.edit')
                                                @endcan
                                            @endif

                                            &nbsp;&nbsp;
                                            @if ($task->assigned_by == $task->user_id)
                                                @can('delete_own_task')
                                                    <a class="fa-solid fa-trash-can"
                                                        href= "{{ url('/tasks/delete') }}/{{ $task->id }}"></a>
                                                @endcan
                                            @elseif ($task->assigned_by != $task->user_id)
                                                @can('delete_own_assigned_task')
                                                    <a class="fa-solid fa-trash-can"
                                                        href= "{{ url('/tasks/delete') }}/{{ $task->id }}"></a>
                                                @endcan
                                            @endif


                                            &nbsp;

                                            <a href="{{ url('/viewtask') }}/{{ $task->id }}"
                                                class="btn btn-outline-primary btn-sm">
                                                ({{ $task->comments->count() }})
                                                <i class="far fa-comments"></i>
                                                <span class="ms-1">View </span>
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
