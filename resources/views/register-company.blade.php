@extends('layouts.main')

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



                <div class="container mb-2">
                    <form action="">
                        @csrf
                        <div id="wizard">
                            <h3>
                                <div class="media">
                                    <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
                                    <div class="media-body">
                                        <div class="bd-wizard-step-title">Company Details</div>
                                        <div class="bd-wizard-step-subtitle">Step 1</div>
                                    </div>
                                </div>
                            </h3>
                            <section>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="firstName" id="firstName" class="form-control"
                                        placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lastName" id="lastName" class="form-control"
                                        placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control"
                                        placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="emailAddress">Email Address</label>
                                    <input type="email" name="emailAddress" id="emailAddress" class="form-control"
                                        placeholder="Email Address">
                                </div>
                            </section>
                            <h3>
                                <div class="media">
                                    <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
                                    <div class="media-body">
                                        <div class="bd-wizard-step-title">Employ Details</div>
                                        <div class="bd-wizard-step-subtitle">Step 2</div>
                                    </div>
                                </div>
                            </h3>
                            <section>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="designation" id="designation" class="form-control"
                                        placeholder="Designation">
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" name="department" id="department" class="form-control"
                                        placeholder="Department">
                                </div>
                                <div class="form-group">
                                    <label for="employeeNumber">Employee Number</label>
                                    <input type="text" name="employeeNumber" id="employeeNumber" class="form-control"
                                        placeholder="Employee Number">
                                </div>
                                <div class="form-group">
                                    <label for="workEmailAddress">Work Email Address</label>
                                    <input type="email" name="workEmailAddress" id="workEmailAddress" class="form-control"
                                        placeholder="Work Email Address">
                                </div>
                            </section>
                            <h3>
                                <div class="media">
                                    <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
                                    <div class="media-body">
                                        <div class="bd-wizard-step-title">Review </div>
                                        <div class="bd-wizard-step-subtitle">Step 3</div>
                                    </div>
                                </div>
                            </h3>
                            <section>
                                <h4 class="text-center">Review your Details</h4>
                                <p id="enteredFirstName"></p>
                                <p id="enteredLastName"></p>
                                <p id="enteredPhoneNumber"></p>
                                <p id="enteredEmailAddress"></p>
                                <p id="enteredDesignation"></p>
                                <p id="enteredDepartment"></p>
                                <p id="enteredEmployeeNumber"></p>
                                <p id="enteredWorkEmailAddress"></p>
                            </section>
                            <h3>
                                <div class="media">
                                    <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
                                    <div class="media-body">
                                        <div class="bd-wizard-step-title">Submit</div>
                                        <div class="bd-wizard-step-subtitle">Step 4</div>
                                    </div>
                                </div>
                            </h3>
                            <section>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="agreement">
                                    <label class="form-check-label" for="agreement">I hereby declare that I had read all
                                        the
                                        <a href="#">terms and conditions</a> and all the details provided my me in
                                        this
                                        form are true.</label>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </section>
                        </div>
                    </form>
                </div>




            </div>
        </section>
    </div>


    @push('scripts')
        <script src="assets/js/jquery.steps.min.js"></script>
        <script src="assets/js/bd-wizard.js"></script>
    @endpush

    @push('styles')
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/css/bd-wizard.css">
    @endpush
@endsection
