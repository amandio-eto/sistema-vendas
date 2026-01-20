@extends('Master.Master')
@section('title','Products')

@section('content')

<div class="row m-3">
    <div class="col-12">

        <!-- ===================== -->
        <!-- Product Form -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <div class="mb-3">
                    <h5 class="fw-semibold mb-0">Create Product</h5>
                    <small class="text-muted">Add new product information</small>
                </div>

                <form action="" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- Code Product -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Product Code</label>
                            <input type="text"
                                   name="code_product"
                                   class="form-control"
                                   placeholder="PRD-001">
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Product Name</label>
                            <input type="text"
                                   name="product_name"
                                   class="form-control"
                                   placeholder="Product Name"
                                   required>
                        </div>

                        <!-- Quality -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Quality</label>
                            <input type="text"
                                   name="quality"
                                   class="form-control"
                                   placeholder="High / Medium / Low">
                        </div>

                    </div>

                    <!-- Action -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-light me-2">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success px-4">
                            ✔ Save Product
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- ===================== -->
        <!-- Product Table -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold mb-0">Product List</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="small text-muted">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Product Name</th>
                                <th>Quality</th>
                                <th>Created</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- Example Static Data --}}
                            <tr>
                                <td>1</td>
                                <td>PRD-001</td>
                                <td>Rice Premium</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        High
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    2026-01-19
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
