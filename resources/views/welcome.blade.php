@extends('layouts.main')
@push('page-title')
    <title>Welcome</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">

        </div>
        <!-- /.content-header -->

        <section>
            <div class="container-fluid">

                <div class="row flex-lg-row align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="/dist/img/hero.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700"
                            height="500" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3">Register Your Company Free!!</h1>
                        <p class="lead">With TaskMan, managing your tasks has never
                            been easier. Our comprehensive solution allows you to effortlessly assign tasks, implement
                            role-based user registration and assignment, and streamline user management processes. Take
                            control of your company's productivity and efficiency with TaskMan, the ultimate tool
                            for successful task management and company</p>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            @auth
                            @else
                                <button type="button" class="btn btn-success btn-lg px-4 me-md-2">Register</button>
                            @endauth
                        </div>
                    </div>
                </div>


            </div>
        </section>

    </div>
@endsection
