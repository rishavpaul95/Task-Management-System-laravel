@extends('layouts.main')
@push('page-title')
    <title>Roles</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Roles</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">


                <div class="py-5 w-100">
                    <div class="container">
                        <div class="card shadow-sm p-2">
                            <div class="d-flex justify-content-end p-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createRoleModal">Create Role</button>
                            </div>

                            <table class="table" id="rolesControlTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th class="d-flex justify-content-center" scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="d-flex align-items-center btn-group">
                                                        <a href="{{ url('/roles/addpermission') }}/{{ $role->id }}"
                                                            class="btn btn-primary btn-sm d-flex align-items-center">
                                                            <i class="fa-solid fa-plus-square"></i>
                                                            <span class="ml-2">Edit Permissions</span>
                                                        </a>
                                                        &nbsp;&nbsp;

                                                        @include('modals.roles.edit')


                                                        &nbsp;&nbsp;
                                                        <a class="fa-solid fa-trash-can"
                                                            href="{{ url('/roles/delete') }}/{{ $role->id }}"></a>
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

                <!-- Create Role Modal -->
                <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog"
                    aria-labelledby="createRoleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('/roles/add') }}" enctype='multipart/form-data'>
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <!-- Add more form fields as per your requirements -->
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#rolesControlTable').DataTable({
                        "paging": true,

                        "searching": true,
                        "ordering": false,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                    });
                });
            </script>
        @endpush

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
