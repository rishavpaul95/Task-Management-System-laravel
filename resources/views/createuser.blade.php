@extends('layouts.main')
@push('page-title')
    <title>Add User</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">



                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section>
            <div class="container-fluid">

                <div class="container">


                    <div class="row">
                        <div class="col-lg-8 mx-auto">



                            @if ($errors->any())
                                <ul class="alert alert-warning">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Create User
                                        <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('users') }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Email</label>
                                            <input type="text" name="email" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Roles</label>
                                            <select name="roles[]" class="select2" multiple="multiple"
                                                data-placeholder="Select a Role" style="width: 100%;">

                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Send Invite Link</h4>
                                </div>

                                <form action="{{ route('users.invite') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inviteEmail">Email</label>
                                            <input type="email" name="email" id="email" class="form-control mb-3"
                                                placeholder="Email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <button type="submit" class="btn btn-primary">Send Invite</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </section>

        @push('scripts')
            <script>
                $(function() {
                    //Initialize Select2 Elements
                    $('.select2').select2()
                });
                @if (session('success'))
                    toastr.success('{{ session('success') }}', 'Success');
                @endif

                @if (session('error'))
                    toastr.error('{{ session('error') }}', 'Error');
                @endif

                @if (session('status'))
                    toastr.info('{{ session('status') }}', 'Status');
                @endif
            </script>
        @endpush

    </div>

@endsection
