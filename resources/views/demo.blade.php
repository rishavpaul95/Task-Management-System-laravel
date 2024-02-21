

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
                        <h1 class="m-0">Contact</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
            


                <h1>
                    Welcome, {{ $name ?? 'Guest' }}
        
                </h1>
        
        
        
                @if ($name == '')
                    {{ 'you can assign a name' }}
                @endif
                <br>
                {!! $demo !!}


            </div>
        </section>
        
    </div>
  
@endsection
