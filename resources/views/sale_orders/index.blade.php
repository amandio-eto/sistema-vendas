@extends('Master.Master')
@section('title','Sales Orders')

@section('content')
<div class="container-fluid mt-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-receipt-cutoff me-2"></i> Sales Order Monitoring
        </h4>
    </div>

    {{-- FORM CREATE SO --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-plus-circle me-1"></i> Create Sales Order
        </div>

        <div class="card-body">
            <form action="{{ route('sale-orders.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small text-muted">SO Number</label>
                        <input type="text" name="so_number" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small text-muted">Client</label>
                        <select name="id_client" class="form-select form-select-sm" required>
                            <option value="">-- Select Client --</option>
                            @foreach(DB::table('clients')->orderBy('client_name')->get() as $client)
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small text-muted">Product</label>
                        <select name="id_product" class="form-select form-select-sm" required>
                            <option value="">-- Select Product --</option>
                            @foreach(DB::table('products')->orderBy('product_name')->get() as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted">Quantity (Liter)</label>
                        <input type="number" step="0.01" name="quantity"
                               class="form-control form-control-sm text-end" required>
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success small">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    {{-- TABLE SO --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-table me-1"></i> Sales Order Status
        </div>

        <div class="card-body p-0">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>SO Number</th>
                        <th>Client</th>
                        <th>Product</th>
                        <th class="text-end">SO Total (L)</th>
                        <th class="text-end">Delivered (L)</th>
                        <th class="text-end">Remaining (L)</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($soList as $so)
                        <tr class="{{ $so->over_delivery ? 'table-danger' : '' }}">
                            <td class="fw-semibold">{{ $so->so_number }}</td>
                            <td>{{ $so->client_name }}</td>
                            <td>{{ $so->product_name }}</td>

                            <td class="text-end">
                                {{ number_format($so->so_total,2) }} L
                            </td>

                            <td class="text-end">
                                {{ number_format($so->total_delivered,2) }} L
                            </td>

                            <td class="text-end fw-semibold">
                                {{ number_format($so->remaining,2) }} L
                            </td>

                            <td class="text-center">
                                @if($so->over_delivery)
                                    <span class="badge bg-danger">
                                        Over
                                    </span>
                                @elseif($so->remaining <= 0)
                                    <span class="badge bg-secondary">
                                        Closed
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No Sales Order Data Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
