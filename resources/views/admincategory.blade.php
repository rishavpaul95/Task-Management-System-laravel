@extends('layouts.main')
@push('page-title')
    <title>Edit Categories</title>
@endpush
@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Categories</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">




                <div class="container mt-5">
                    <h2>Categories</h2>

                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addCategoryModal">
                            Add Categories
                        </button>


                        {{-- Add Modal Start --}}

                        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/admin/categories/add') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="category">Category:</label>
                                                <input type="text" class="form-control" id="category" name="category"
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Category</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Add Categories Modal End --}}

                    </div>

                    <hr>

                    <!-- Categories Table -->
                    <table class=" table" id="categoriesTable">
                        <thead>
                            <tr>
                                <th colspan="5">Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>

                                    <td colspan="5">{{ $category->category }}</td>

                                    <td><a href= "{{ url('/admin/categories/delete') }}/{{ $category->id }}"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                        <!-- Edit Button trigger modal -->

                                        &nbsp;&nbsp;

                                        <i class="fa-regular fa-pen-to-square" type="button"
                                            class="fa-regular fa-pen-to-square" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal{{ $category->id }}">

                                        </i>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                            aria-labelledby="editCategoryModal{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCategoryModal">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ url('/admin/categories/edit') }}/{{ $category->id }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="category">Category:</label>
                                                                <input type="text" class="form-control" id="category"
                                                                    name="category" value="{{ $category->category }}"
                                                                    required>
                                                            </div>
                                                            <button type= "submit" class="btn btn-primary">Edit
                                                                Category
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>







            </div>
    </div>

    </div>
@endsection
