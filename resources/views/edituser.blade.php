@extends('layouts.main')
@push('page-title')
<title>Edit User</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">



                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
        <!-- /.content-header -->

        <section>
            <div class="container-fluid">



                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-12">

                            @if ($errors->any())
                            <ul class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit User
                                        <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('users/'.$user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="">Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Email</label>
                                            <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Password</label>
                                            <input type="text" name="password" class="form-control" />
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Roles</label>
                                            <select name="roles[]" class="form-control" multiple>

                                                @foreach ($roles as $role)
                                                <option
                                                    value="{{ $role }}"
                                                    {{ in_array($role, $userRoles) ? 'selected':'' }}>
                                                    {{ $role }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
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

    </div>

@endsection

