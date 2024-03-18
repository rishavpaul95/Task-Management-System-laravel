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
                @if (!$lead)
                    <p>No lead data available.</p>
                @else
                    <h2>Hey, {{ $lead->name }} !</h2>

                    <pre>


                    <h6>
                    We will contact you at <u>{{ $lead->email }} </u>

                    Look forward to hearing from us!!

                    </h6>
                </pre>
                @endif
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
