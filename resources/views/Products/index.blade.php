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

                <div class="mb-3 text-center">
                    <h5 class="fw-semibold mb-0">Create Product</h5>
                    <small class="text-muted">Add new product information</small>
                </div>
                <hr>

                <form action="{{ route('product.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- Code Product -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Product Code</label>
                            <input type="text"
                                   name="code_product"
                                   value="{{ old('code_product') }}"
                                   class="form-control @error('code_product') is-invalid @enderror"
                                   placeholder="PRD-001">

                            @error('code_product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Product Name</label>
                            <input type="text"
                                   name="product_name"
                                   value="{{ old('product_name') }}"
                                   class="form-control @error('product_name') is-invalid @enderror"
                                   placeholder="Product Name">

                            @error('product_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Quality -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Quality</label>
                            <input type="text"
                                   name="quality"
                                   value="{{ old('quality') }}"
                                   class="form-control @error('quality') is-invalid @enderror"
                                   placeholder="High / Medium / Low">

                            @error('quality')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <!-- Action -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-danger me-2">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-success px-4">
                             Save <i class="bi bi-send"></i>
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

                <h6 class="fw-semibold mb-3 text-center">
                    {{ Str::upper('Product List') }}
                </h6>
                <hr>

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
                        @foreach ($products as $key => $p)
                            <tr>
                                <td>{{ $products->firstItem() + $key }}</td>
                                <td>{{ $p->code_product }}</td>
                                <td>{{ $p->product_name }}</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        {{ $p->quality }}
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('product.edit',$p->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('product.destroy',$p->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this product?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $products->links() }}

            </div>
        </div>

    </div>
</div>

@endsection
