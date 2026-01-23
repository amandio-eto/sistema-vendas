@extends('Master.Master')
@section('title', 'Edit Product')

@section('content')
<div class="container-fluid px-4">

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <!-- ===================== -->
            <!-- Edit Product Card -->
            <!-- ===================== -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h5 class="fw-semibold text-uppercase mb-1">
                            Edit Product
                        </h5>
                        <p class="text-muted small mb-0">
                            Update product information carefully
                        </p>
                    </div>

                    <hr class="mb-4">

                    <!-- Form -->
                    <form action="{{ route('product.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            <!-- Product Code -->
                            <div class="col-md-4">
                                <label class="form-label text-muted small">
                                    Product Code
                                </label>
                                <input type="text"
                                       class="form-control form-control-sm bg-light"
                                       value="{{ old('code_product', $product->code_product) }}"
                                       readonly>
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-4">
                                <label class="form-label text-muted small">
                                    Product Name
                                </label>
                                <input type="text"
                                       name="product_name"
                                       class="form-control form-control-sm"
                                       value="{{ old('product_name', $product->product_name) }}"
                                       placeholder="Product name"
                                       required>
                            </div>

                            <!-- Quality -->
                            <div class="col-md-4">
                                <label class="form-label text-muted small">
                                    Quality
                                </label>
                                <input type="text"
                                       name="quality"
                                       class="form-control form-control-sm"
                                       value="{{ old('quality', $product->quality) }}"
                                       placeholder="High / Medium / Low">
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end align-items-center mt-5">
                            <a href="{{ route('product.index') }}"
                               class="btn btn-outline-secondary btn-sm me-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="btn btn-warning btn-sm px-4">
                                Update Product
                            </button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>

</div>
@endsection
