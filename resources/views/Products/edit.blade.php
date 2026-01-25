@extends('Master.Master')
@section('title', 'Edit Product')

@section('content')
<div class="container-fluid px-4 mt-3">

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

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
                                       class="form-control form-control-sm @error('product_name') is-invalid @enderror"
                                       value="{{ old('product_name', $product->product_name) }}"
                                       placeholder="Product name">

                                @error('product_name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <!-- Quality -->
                            <div class="col-md-4">
                                <label class="form-label text-muted small">
                                    Quality
                                </label>
                                <input type="text"
                                       name="quality"
                                       class="form-control form-control-sm @error('quality') is-invalid @enderror"
                                       value="{{ old('quality', $product->quality) }}"
                                       placeholder="High / Medium / Low">

                                @error('quality')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end align-items-center mt-5">
                            <a href="{{ route('product.index') }}"
                               class="btn btn-primary btn-sm me-2">
                                Back
                            </a>
                            <button type="submit"
                                    class="btn btn-warning btn-sm px-4">
                                Update <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
