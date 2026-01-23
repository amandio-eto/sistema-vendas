@extends('Master.Master')
@section('title','Transactions')

@section('content')
<div class="container-fluid px-4">

    <!-- ===================== -->
    <!-- Transaction Form -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="text-center mb-4 border-bottom pb-2">
                <h5 class="fw-semibold mb-1 text-uppercase">Create Transaction</h5>
                <small class="text-muted">Add new transaction</small>
            </div>

            <form action="{{ route('transaction.create') }}" method="POST">
                @csrf
                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label text-muted small">DO Number</label>
                        <input type="number" name="do_number" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small">LO Number</label>
                        <input type="number" name="lo_number" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small">SO Number</label>
                        <input type="text" name="so_number" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small">Product</label>
                        <select name="id_product" class="form-select form-select-sm">
                             <option  >--Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small">Client</label>
                        <select name="id_client" class="form-select form-select-sm">
                             <option  >--Select Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small">Driver</label>
                        <select name="id_driver" class="form-select form-select-sm">
                             <option  >--Select Drive --</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->driver_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label text-muted small">Quantity</label>
                        <input type="number" step="0.01" name="quantity" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label text-muted small">Authorized By</label>
                        <input type="text" name="authorized_by" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label text-muted small">Plat Number</label>
                        <input type="text" name="plat_number" class="form-control form-control-sm">
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-danger btn-sm me-2">Reset</button>
                    <button type="submit" class="btn btn-success btn-sm px-4">
                        Save <i class="bi bi-send"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ===================== -->
    <!-- Transaction Table -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h6 class="fw-semibold text-uppercase mb-0">Transaction List</h6>

                <!-- Search -->
                <form method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control form-control-sm me-2" placeholder="Search DO, SO, client...">
                    <button class="btn btn-sm btn-primary">Search</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>#</th>
                            <th>DO</th>
                            <th>SO</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Driver</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Authorized</th>
                            <th>Plat</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($transactions as $key => $tx)
                        <tr class="small">
                            <td>{{ $transactions->firstItem() + $key }}</td>
                            <td class="fw-semibold">{{ $tx->do_number }}</td>
                            <td>{{ $tx->so_number }}</td>
                            <td>{{ $tx->product_type }}</td>
                            <td>{{ $tx->client_name }}</td>
                            <td>{{ $tx->driver_name }}</td>
                            <td>{{ number_format($tx->quantity, 2) }}</td>
                            <td>
                                <span class="badge {{ $tx->status ? 'bg-success' : 'bg-warning' }}">
                                    {{ $tx->status ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $tx->authorized_by }}</td>
                            <td>{{ $tx->plat_number }}</td>
                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($tx->created_at)->format('d M Y H:i') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('transaction.edit', $tx->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('transaction.destroy', $tx->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this transaction?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                                No transactions found
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $transactions->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
