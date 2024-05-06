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
                        <h1 class="m-0">Company Profile</h1>
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
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="card-header">
                                                    <h5 class="font-weight-bold">Company Code</h5>
                                                </div>
                                                <p id="companyCode" class="mb-0 text-primary" style="font-size: 1.2em;">
                                                    {{ $company->company_code }}</p>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button class="btn btn-primary" onclick="copyToClipboard()">Copy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="container">
                                        <form method="POST" action="{{ route('company.update') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="companyName">Company Name</label>
                                                <input type="text" name="companyName" id="companyName"
                                                    class="form-control" placeholder="Name"
                                                    value="{{ old('companyName', $company->name) }}" required>
                                                @error('companyName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="companyEmail">Company Email</label>
                                                <input type="text" name="companyEmail" id="companyEmail"
                                                    class="form-control" placeholder="Email"
                                                    value="{{ old('companyEmail', $company->email) }}" required>
                                                @error('companyEmail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="companyWebsite">Company Website</label>
                                                <input type="text" name="companyWebsite" id="companyWebsite"
                                                    class="form-control" placeholder="Website"
                                                    value="{{ old('companyWebsite', $company->website) }}">
                                                @error('companyWebsite')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="companyAddress">Company Address</label>
                                                <input type="text" name="companyAddress" id="companyAddress"
                                                    class="form-control" placeholder="Address"
                                                    value="{{ old('companyAddress', $company->address) }}" required>
                                                @error('companyAddress')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>








                        </div>
                    </div>
                </div>


            </div>
        </section>



        @push('scripts')
            <script>
                function copyToClipboard() {
                    var companyCode = document.getElementById('companyCode').innerText;
                    var textarea = document.createElement('textarea');
                    textarea.id = 'tempElement';
                    textarea.style.height = 0;
                    document.body.appendChild(textarea);
                    textarea.value = companyCode;
                    var selector = document.querySelector('#tempElement');
                    selector.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                    toastr.success('Company code copied to clipboard', 'Success');
                }

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
