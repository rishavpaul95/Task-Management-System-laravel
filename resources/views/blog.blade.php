@extends('layouts.main')
@push('page-title')
    <title>Blog</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blog</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <!-- Blog entries-->
                        <div class="col-lg-8">
                            <!-- Featured blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top border" src="/dist/img/blog_img1.jpg"
                                        alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">May 1, 2024</div>
                                    <h2 class="card-title">TaskMan Overview</h2>
                                    <p class="card-text">Learn about TaskMan and its features. TaskMan provides an easy way
                                        to manage your...</p>
                                    <a class="btn btn-primary" href={{ url('/blog/post1') }}>Read more →</a>
                                </div>
                            </div>
                            <!-- Nested row for non-featured blog posts-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Blog post-->
                                    <div class="card mb-4">
                                        <a href="#!"><img class="card-img-top"
                                                src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                        <div class="card-body">
                                            <div class="small text-muted">May 2, 2024</div>
                                            <h2 class="card-title h4">Rishav Paul</h2>
                                            <p class="card-text">Learn about Rishav Paul, the Dev behind TaskMan!</p>
                                            <a class="btn btn-primary" href={{ url('/blog/post2') }}>Read more →</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Side widgets-->
                        <div class="col-lg-4">
                            <!-- Search widget-->
                            <div class="card mb-4">
                                <div class="card-header">Search</div>
                                <div class="card-body">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Coming Soon..."
                                            aria-label="Enter search term..." aria-describedby="button-search" />
                                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                                    </div>
                                </div>
                            </div>


                            <div class="">
                                <div class="info-box bg-info">
                                    <span class="info-box-icon"><i class="far fa-user"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Visits</span>
                                        <span class="info-box-number">41,410</span>

                                        <div class="progress">
                                            <div class="progress-bar" style="width: 70%"></div>
                                        </div>
                                        <span class="progress-description">
                                            70% Increase in 30 Days
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>



                        </div>
                    </div>
                </div>
        </section>

    </div>
@endsection
