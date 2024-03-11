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
                                            <select name="roles[]" class="form-control" multiple>

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
                        </div>
                    </div>
                </div>


            </div>
        </section>

    </div>

@endsection

