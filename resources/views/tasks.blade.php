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
                    </div>
                    <div class="d-flex col-md-3 justify-content-center">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
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
                                @foreach ( $tasks as $task)
                                <tr>
                                    <th scope="row">{{ \Carbon\Carbon::parse($task->date)->format('d, M, Y') }} </th>
                                    <td>{{$task->topic }}</td>
                                    <td>{{$task->status }}</td>
                                    <td><button></button></td>
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
