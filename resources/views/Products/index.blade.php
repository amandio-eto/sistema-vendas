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
                        <button type="reset" class="btn btn-danger me-2">
                            Reset
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

                <div class="d-flex justify-content-between align-items-center mb-3 text-center">
                    <h6 class="fw-semibold mb-0 text-center">{{ Str::upper('Product List') }}</h6>
                </div>
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

                            {{-- Example Static Data --}}
                            @foreach ($products as $key=>$p)
                                
                           
                            <tr>
                                <td>{{ $products->firstItem() + $key }}</td>
                                <td>{{ $p->code_product }}</td>
                                <td>{{ $p->product_name }}</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        {{ '#'.$p->quality }}
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}
                                </td>
                                <form action="{{ route('product.destroy',['id'=>$p->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                <td class="text-end">
                                   <a href="{{ route('product.edit',['id'=>$p->id]) }}" class="btn btn-sm btn-warning">
                                       <i class="bi bi-pencil-square"></i>
                                    </a> |
                                    
                                    <button type="submit" class="btn btn-sm btn-danger">
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
