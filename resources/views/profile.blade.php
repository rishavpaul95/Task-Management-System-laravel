@extends('layouts.main')
@push('page-title')
    <title>Profile</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">




                <div class="container py-5">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('profile.partials.update-profile-information-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('profile.partials.update-password-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('profile.partials.delete-user-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </section>

    </div>
@endsection
