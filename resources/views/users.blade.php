@extends('layouts.main')
@push('page-title')
    <title>User</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">



                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Users

                            <a href="{{ url('users/create') }}" class="btn btn-success float-end">Add User</a>

                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{ url('users/' . $user->id . '/edit') }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>

                                            &nbsp;&nbsp;

                                            <a href="{{ url('users/' . $user->id . '/delete') }}">
                                                <i class="fa-solid fa-trash-can"></i>
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
