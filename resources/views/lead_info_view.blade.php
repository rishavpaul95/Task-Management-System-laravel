@extends('layouts.main')
@push('page-title')
    <title>Contact</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> </h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">

                <h2>Hey, {{ $leadData->name }} !</h2>

                <pre>


                    <h6>
                    We will contact you at <u>{{ $leadData->email }} </u>

                    Look forward to hearing from us!!

                    </h6>
                </pre>

            </div>
        </section>

    </div>
@endsection
