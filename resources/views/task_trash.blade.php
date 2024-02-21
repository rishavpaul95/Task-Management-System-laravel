@extends('layouts.main')
@push('page-title')
    <title>Trash</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Trash</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <a href="{{url('/tasks')}}"><button class="btn btn-success">Task List</button></a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">





                <table class="table">
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
                                <td><a href= "{{ url('/tasks/permadelete') }}/{{ $task->id }}"><button type="button"
                                            class="btn btn-danger">Delete</button></a>

                                    <a href= "{{ url('/tasks/restore') }}/{{ $task->id }}"><button type="button"
                                            class="btn btn-success">Restore</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- table end --}}
            </div>
    </div>

    </div>
@endsection
