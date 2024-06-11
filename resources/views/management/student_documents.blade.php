@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Manage Products</h5>
                        </div>
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
                    <div class="table-responsive">
                        <table id="enrolledStudentsTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stock
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Discount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentDocuments as $studentDocuments)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->product_id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->product_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->price }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->stock }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->category }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->discount }}</p>
                                    </td>
                                    <td style="text-align:center">
                                        <a class="btn btn-primary btn-sm view-btn text-white" data-toggle="modal"
                                            data-target="#viewStudentModal{{ $studentDocuments->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm view-btn text-white" data-toggle="modal"
                                            data-target="#editStudentModal{{ $studentDocuments->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $studentDocuments->id }}"
                                            action="{{ route('delete_enrollee', $studentDocuments->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                <!-- View Modal -->
                                <div class="modal fade" id="viewStudentModal{{ $studentDocuments->id }}" tabindex="-1"
                                    aria-labelledby="viewStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewStudentModalLabel">Student Information
                                                </h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" id="modal-body-content">
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <strong>Student ID:</strong>
                                                        <span>{{ $studentDocuments->student_id }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <strong>Last Name:</strong>
                                                        <span>{{ $studentDocuments->last_name }}</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <strong>First Name:</strong>
                                                        <span>{{ $studentDocuments->first_name }}</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <strong>Middle Name:</strong>
                                                        <span>{{ $studentDocuments->middle_name }}</span>
                                                    </div>
                                                </div>
                                                <!-- File Attachment Section -->
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <strong>Birth Certificate:</strong>
                                                        @if($studentDocuments->birth_certificate)
                                                        <a
                                                            href="{{ route('download_student_document', ['id' => $studentDocuments->id, 'type' => 'birth_certificate']) }}">Download</a>
                                                        @else
                                                        Not Submitted
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <strong>Form 137:</strong>
                                                        @if($studentDocuments->form_137)
                                                        <a
                                                            href="{{ route('download_student_document', ['id' => $studentDocuments->id, 'type' => 'form_137']) }}">Download</a>
                                                        @else
                                                        Not Submitted
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <strong>Transcript Generation:</strong>
                                                        @if($studentDocuments->transcript_generation)
                                                        <a
                                                            href="{{ route('download_student_document', ['id' => $studentDocuments->id, 'type' => 'transcript_generation']) }}">Download</a>
                                                        @else
                                                        Not Submitted
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <strong>Good Moral:</strong>
                                                        @if($studentDocuments->good_moral)
                                                        <a
                                                            href="{{ route('download_student_document', ['id' => $studentDocuments->id, 'type' => 'good_moral']) }}">Download</a>
                                                        @else
                                                        Not Submitted
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editStudentModal{{ $studentDocuments->id }}" tabindex="-1"
                                    aria-labelledby="editStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('update_student_documents', $studentDocuments->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStudentModalLabel">Student Documents
                                                        Information</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="modal-body-content">
                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <strong>Student ID:</strong>
                                                            <span>{{ $studentDocuments->student_id }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4">
                                                            <strong>Last Name:</strong>
                                                            <span>{{ $studentDocuments->last_name }}</span>
                                                        </div>
                                                        <div class="col-4">
                                                            <strong>First Name:</strong>
                                                            <span>{{ $studentDocuments->first_name }}</span>
                                                        </div>
                                                        <div class="col-4">
                                                            <strong>Middle Name:</strong>
                                                            <span>{{ $studentDocuments->middle_name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2" style="text-align: center; color: red;">
                                                        <strong>Note: Only images are accepted, specifically in JPG,
                                                            JPEG, and PNG formats.</strong>
                                                    </div>
                                                    <!-- File Attachment Section -->
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <strong>Birth Certificate:</strong>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"
                                                                    name="birth_certificate">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <strong>Form 137:</strong>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" name="form_137">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-12">
                                                                <strong>Transcript Generation:</strong>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control"
                                                                        name="transcript_generation">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-12">
                                                                <strong>Good Moral:</strong>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control"
                                                                        name="good_moral">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

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