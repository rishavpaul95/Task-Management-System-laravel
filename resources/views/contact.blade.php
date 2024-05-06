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
                    <div class="col-sm-12 text-center">
                        <h2 class="m-0">Let Us Reach-Out!</h2>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form id = "contact-form" action="{{ url('/') }}/contact" method="POST"
                            class="p-3 border rounded bg-light">
                            @csrf
                            <x-contact-form type="text" name="name" placeholder="Name" label="Name" />
                            <x-contact-form type="email" name="email" placeholder="Email" label="Email" />
                            <x-contact-form type="text" name="address" placeholder="1234 Main St" label="Address" />
                            <x-contact-form type="text" name="city" placeholder="City" label="City" />
                            <x-contact-form type="text" name="zip" placeholder="Zip" label="Zip" />

                            <div class="form-check mb-3 text-center">
                                <input type="checkbox" class="form-check-input" name="receive_product_info" value="1"
                                    checked>
                                <label class="form-check-label text-center">
                                    Do you want to receive updates from us?
                                </label>
                            </div>
                            <div class="form-check mb-3 text-center">
                                <input type="checkbox" class="form-check-input" name="receive_daily_updates" value="1"
                                    checked>
                                <label class="form-check-label">
                                    Do you want to receive daily updates?
                                </label>
                            </div>

                            <!-- reCAPTCHA -->
                            <div class="form-group text-center">
                                <div class="g-recaptcha d-inline-block" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Contact</button>
                        </form>
                    </div>
                </div>
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

                @if (session('status'))
                    toastr.info('{{ session('status') }}', 'Status');
                @endif
            </script>
        @endpush
    </div>
@endsection
