@extends('Master.Master')
@section('title','Transactions')



@section('content')
<div class="container-fluid px-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3 bg-light p-2 rounded">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Transactions</li>
      </ol>
    </nav>

    <!-- ===================== -->
    <!-- Transaction Form -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm rounded mb-4">
        <div class="card-body">

            <div class="text-center mb-4 border-bottom pb-2">
                <h5 class="fw-bold text-uppercase mb-1">Create Transaction</h5>
                <small class="text-muted">Add new transaction</small>
            </div>

            <form action="{{ route('transaction.create') }}" method="POST">
                @csrf
                <div class="row g-3">

                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <div class="p-3 bg-success text-white rounded w-100 text-center shadow-sm">
                            <h6 class="mb-0 text-white">DO Number</h6>
                            <span class="fs-4 fw-bold"># {{ $ndo }}</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted">LO Number</label>
                        <input type="number" name="lo_number" value="{{ old('lo_number') }}" class="form-control form-control-sm">
                        @error('lo_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted">SO Number</label>
                        <input type="text" name="so_number" value="{{ old('so_number') }}" class="form-control form-control-sm">
                        @error('so_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted">Product</label>
                        <select name="id_product" class="form-select form-select-sm">
                             <option value="">--Select Product--</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('id_product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name."#".$product->quality }} 
                                </option>
                            @endforeach
                        </select>
                        @error('id_product')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted">Client</label>
                        <select name="id_client" class="form-select form-select-sm">
                             <option value="">--Select Client--</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('id_client') == $client->id ? 'selected' : '' }}>
                                    {{ $client->client_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_client')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted">Driver</label>
                        <select name="id_driver" class="form-select form-select-sm">
                             <option value="">--Select Driver--</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->driver_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_driver')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label text-muted">Quantity</label>
                        <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" class="form-control form-control-sm">
                        <span class="text-muted small">L(Liter)</span>
                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label text-muted">Plat Number</label>
                        <input type="text" name="plat_number" value="{{ old('plat_number') }}" class="form-control form-control-sm">
                        @error('plat_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-outline-danger btn-sm me-2">Reset</button>
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
    <div class="card border-0 shadow-sm rounded">
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
                <table class="table table-hover align-middle mb-0 table-striped table-bordered" style="font-size: 10px;">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>#</th>
                            <th>DO</th>
                            <th>SO</th>
                            <th>LO</th>
                            <th>Code Product</th>
                            <th>Quality</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Driver</th>
                            <th>Quantity(L)</th>
                            <th>Quantity(Ton)</th>
                            <th>Status</th>
                            <th>Authorized</th>
                            <th>Plat</th>
                            <th>Request</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($transactions as $key => $tx)
                        <tr class="{{ $tx->status ? '' : 'table-warning' }}">
                            <td>{{ $transactions->firstItem() + $key }}</td>
                            <td class="fw-bold">{{ $tx->do_number }}</td>
                            <td>{{ $tx->so_number }}</td>
                            <td>{{ $tx->lo_number }}</td>
                            <td>{{ $tx->code_product }}</td>
                            <td>{{ $tx->quality }}</td>
                            <td>{{ $tx->product_name }}</td>
                            <td>{{ $tx->client_name }}</td>
                            <td>{{ $tx->driver_name }}</td>
                            <td>{{ number_format($tx->quantity, 2, ',', '.') }}</td>
                            <td>{{ format_ton($tx->quantity) }}</td>
                            <td>
                                <span class="badge {{ $tx->status ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $tx->status ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $tx->authorized_by ?? '-' }}</td>
                            <td>{{ $tx->plat_number }}</td>
                            <td>
                           

                            @if(!$tx->statusedit===false)
                             <i class="bi bi-unlock text-danger"></i>
                               
                            @else
                             <form action="{{ route('statusedit',['id'=>$tx->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-file-lock"></i>
                                    </button>
                                </form>
                               
                            @endif
                            </td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($tx->created_at)->translatedFormat('d M Y H:i') }}</td>
                            <td class="text-end">

                                   
                                       
                                    @if($user = Auth::user()->roleid === 1 && $tx->button)
                                        <a href="{{ route('transaction.edit', $tx->id) }}"
                                        class="btn btn-sm btn-warning me-1"
                                        title="Edit Transaction">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @elseif(Auth::user()->role==='administrator')
                                     <a href="{{ route('transaction.edit', $tx->id) }}"
                                        class="btn btn-sm btn-warning me-1"
                                        title="Edit Transaction">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('transaction.destroy', $tx->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this transaction?')"
                                                    title="Delete Transaction">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if($tx->status)
                                    <a href="{{ route('transaction.print', $tx->id) }}"
                                    class="btn btn-sm btn-secondary me-1"
                                    title="Print Transaction">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                @endif
                                  

                            
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center text-muted py-4">
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
