@extends('layouts.main')
@push('page-title')
    <title>Add Permissions To Role</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Role Permissions</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">




                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-12">

                            @if (session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h4>Role : {{ $role->name }}
                                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ url('/roles/addpermission') }}/{{ $role->id }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            @error('permission')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <label for="">Permissions</label>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-md-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="permission[]" value="{{ $permission->name }}"
                                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                id="permissionCheck{{ $permission->id }}">
                                                            <label class="form-check-label"
                                                                for="permissionCheck{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
