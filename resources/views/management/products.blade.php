<!-- enrolled_students.blade.php -->

@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Products</h5>
                        </div>
                        <a href="/add_products" class="btn bg-gradient-success btn-sm mb-0" type="button">+&nbsp;
                            Add Products</a>
                    </div>
                    @if(session('success'))
                    <!-- Success message display -->
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                </div>
                <hr>
                <div class="card-body pt-0 pb-2">
                    <div class="container">
                        <div class="row">
                            @foreach ($viewProducts as $prod_details)
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <img src="{{ asset('storage/products_image/' . $prod_details->product_image) }}" alt="Product Image" class="img-fluid" style="max-width: 100%; height: auto;">
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold">ID: {{ $prod_details->product_id }}</p>
                                        <p class="card-text font-weight-bold">Name: {{ $prod_details->product_name }}</p>
                                        <p class="card-text text-secondary font-weight-bold">Category: {{ $prod_details->category }}</p>
                                        <p class="card-text font-weight-bold">Price: {{ $prod_details->product_price }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a class="btn btn-success btn-sm view-btn text-white" data-toggle="modal" data-target="#viewStudentModal{{ $prod_details->product_id }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-secondary btn-sm view-btn text-white" href="{{ route('management.product_details', $prod_details->product_id) }}">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm text-white" href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this product?')) document.getElementById('delete-form-{{ $prod_details->product_id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <form id="delete-form-{{ $prod_details->product_id }}" action="{{ route('delete_enrollee', $prod_details->product_id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .card-body {
        padding: 1rem;
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }

    .card-text {
        margin-bottom: 0.5rem;
    }

    .btn-group .btn {
        margin-right: 0.2rem;
    }
</style>


<script>
    $(document).ready(function () {
        var table = $('#enrolledStudentsTable').DataTable();
        $('#search').on('keyup', function () {
            table.search($(this).val()).draw();
        });
    });
</script>

@endsection

<!-- Add these links to the head section of your HTML -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Add these links to the head section of your HTML -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
