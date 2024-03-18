@extends('layouts.main')
@push('page-title')
    <title>Task Board</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Task Board</h1>
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



                <div class="row">
                    <div class="col-md-12">
                        <table id="alltasksTable" class="table">
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
                                            {{-- own task --}}
                                            @if ($task->assigned_by == $task->user_id)
                                                @can('edit_own_task')
                                                    @include('modals.alltasks.editmodal')
                                                @endcan
                                                {{-- other user task --}}
                                            @elseif ($currentUser->id != $task->user_id && $currentUser->id != $task->assigned_by)
                                                @can('edit_others_task')
                                                    @include('modals.alltasks.editmodal')
                                                @endcan
                                                {{-- user assigned task     --}}
                                            @elseif ($currentUser->id == $task->assigned_by)
                                                @can('edit_assigned_task')
                                                    @include('modals.alltasks.editmodal')
                                                @endcan
                                            @elseif ($task->assigned_by != $task->user_id)
                                                @can('edit_own_assigned_task')
                                                    @include('modals.alltasks.editmodal')
                                                @endcan
                                            @endif


                                            &nbsp;&nbsp;
                                            {{-- own task --}}
                                            @if ($task->assigned_by == $task->user_id)
                                                @can('delete_own_task')
                                                    <a class="fa-solid fa-trash-can"
                                                        href="{{ url('/alltask/delete') }}/{{ $task->id }}">
                                                    </a>
                                                @endcan
                                                {{-- other user task --}}
                                            @elseif ($currentUser->id != $task->user_id && $currentUser->id != $task->assigned_by)
                                                @can('delete_others_task')
                                                    <a class="fa-solid fa-trash-can"
                                                        href="{{ url('/alltask/delete') }}/{{ $task->id }}">
                                                    </a>
                                                @endcan
                                                {{-- user assigned task     --}}
                                            @elseif ($currentUser->id == $task->assigned_by)
                                                @can('delete_assigned_task')
                                                    <a class="fa-solid fa-trash-can"
                                                        href="{{ url('/alltask/delete') }}/{{ $task->id }}">
                                                    </a>
                                                @endcan
                                            @elseif ($task->assigned_by != $task->user_id)
                                                @can('delete_own_assigned_task')
                                                    <a class="fa-solid fa-trash-can"
                                                        href="{{ url('/alltask/delete') }}/{{ $task->id }}">
                                                    </a>
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
