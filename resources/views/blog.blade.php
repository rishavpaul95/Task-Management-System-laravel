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


                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="./dist/img/photo1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><a href="{{url('/blog/post1')}}">Article 1</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="./dist/img/photo2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><a href="{{url('/blog/post2')}}"> Article 2</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="./dist/img/photo3.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><a href="{{url('/blog/post3')}}"> Article 3</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                    

            </div>
    </div>

    </div>
@endsection
