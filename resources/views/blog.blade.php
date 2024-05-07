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
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">May 1, 2024</div>
                                    <h2 class="card-title">TaskMan Overview</h2>
                                    <p class="card-text">Learn how to use TaskMan and its features. TaskMan provides an easy way to manage your...</p>
                                    <a class="btn btn-primary" href={{url('/blog/post1')}}>Read more →</a>
                                </div>
                            </div>
                            <!-- Nested row for non-featured blog posts-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Blog post-->
                                    <div class="card mb-4">
                                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                        <div class="card-body">
                                            <div class="small text-muted">May 2, 2024</div>
                                            <h2 class="card-title h4">Rishav Paul</h2>
                                            <p class="card-text">Learn about Rishav Paul, the Dev behind TaskMan!</p>
                                            <a class="btn btn-primary" href={{url('/blog/post2')}}>Read more →</a>
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
                                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Side widget-->
                            <div class="card mb-4">
                                <div class="card-header">Side Widget</div>
                                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div>
@endsection













