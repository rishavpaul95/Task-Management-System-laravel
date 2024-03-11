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
                        <h2 class="m-0">Let Us Reach-Out!</h2>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <form action="{{ url('/') }}/contact" method="POST">
                            @csrf
                            <x-contact-form type="text" name="name" placeholder="Name" label="Name" />
                            <x-contact-form type="email" name="email" placeholder="Email" label="Email" />
                            <x-contact-form type="text" name="address" placeholder="1234 Main St" label="Address" />
                            <x-contact-form type="text" name="city" placeholder="City" label="City" />
                            <x-contact-form type="text" name="zip" placeholder="Zip" label="Zip" />


                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="receive_product_info" value="1" checked>
                                    Do you want to receive updates from us?
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="receive_daily_updates" value="1" checked>
                                    Do you want to daily updates?
                                </label>
                            </div>


                            <button type="submit" class="btn btn-primary">Contact</button>
                        </form>

                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
