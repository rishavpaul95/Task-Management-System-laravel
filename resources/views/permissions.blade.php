@extends('layouts.main')
@push('page-title')
    <title>Permissions</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permission</h1>
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
                                <a class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createPermissionModal">Create Permission</a>
                                <!-- Create Permission Modal -->
                                <div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog"
                                    aria-labelledby="createPermissionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createPermissionModalLabel">Create Permission
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/permissions/add') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Name:</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>
                                                    <!-- Add more form fields as per your requirements -->
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table" id="permissionsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                <div>
                                                    <div class="btn-group">
                                                        <i class="fa-regular fa-pen-to-square" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editPermissionsModal{{ $permission->id }}"></i>

                                                        <!-- Edit Role Modal -->
                                                        <div class="modal fade"
                                                            id="editPermissionsModal{{ $permission->id }}" tabindex="-1"
                                                            aria-labelledby="editPermissionsModalLabel{{ $permission->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editPermissionsModalLabel{{ $permission->id }}">
                                                                            Edit Permissionn</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST"
                                                                            action="{{ url('/permissions/edit') }}/{{ $permission->id }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="name">Name:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="name" name="name"
                                                                                    value="{{ $permission->name }}"
                                                                                    required>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        &nbsp;&nbsp;
                                                        <a class="fa-solid fa-trash-can"
                                                            href="{{ url('/permissions/delete') }}/{{ $permission->id }}"></a>
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
                @push('scripts')
                    <script>
                        $(document).ready(function() {
                            $('#permissionsTable').DataTable({


                                "searching": true,

                                "info": true,

                                "responsive": true,
                            });
                        });
                    </script>
                @endpush

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
