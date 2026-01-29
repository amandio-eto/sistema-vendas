@extends('Master.Master')
@section('title','Transactions')

@section('content')
<div class="container-fluid px-4 mt-2">

    <!-- ===================== -->
    <!-- Breadcrumb -->
    <!-- ===================== -->
   

    <!-- ===================== -->
    <!-- CREATE TRANSACTION FORM -->
    <!-- ===================== -->
    @if(Auth::user()->roles==='manager')
    @else
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 mt-3">

            <!-- Header -->
            <div class="text-center mb-4">
                <h5 class="fw-bold text-uppercase mb-0">New Delivery Order</h5>
                <small class="text-muted">Create a new transaction record</small>
                <hr class="w-25 mx-auto mt-3">
            </div>

            <form action="{{ route('transaction.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4 align-items-end">

                    <!-- DO NUMBER -->
                    <div class="col-md-3">
                        <div class="border rounded-3 p-3 text-center bg-light h-100">
                            <small class="text-muted d-block">DO Number</small>
                            <span class="fs-4 fw-bold text-success">#{{ $ndo }}</span>
                        </div>
                    </div>

                    <!-- LO -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">LO Number</label>
                        <input type="number" name="lo_number" value="{{ old('lo_number') }}"
                               class="form-control form-control-sm">
                        @error('lo_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- SO -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">SO Number</label>
                        <input type="text" name="so_number" value="{{ old('so_number') }}"
                               class="form-control form-control-sm">
                        @error('so_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- PRODUCT -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Product</label>
                        <select name="id_product" class="form-select form-select-sm">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('id_product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name }} • {{ $product->quality }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_product') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- CLIENT -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Client</label>
                        <select name="id_client" class="form-select form-select-sm">
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('id_client') == $client->id ? 'selected' : '' }}>
                                    {{ $client->client_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_client') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- DRIVER -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Driver</label>
                        <select name="id_driver" class="form-select form-select-sm">
                            <option value="">Select Driver</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->driver_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_driver') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- QUANTITY -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Quantity (Liter)</label>
                        <input type="number" step="0.01" name="quantity"
                               value="{{ old('quantity') }}"
                               class="form-control form-control-sm">
                        @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- PLATE -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Plate Number</label>
                        <input type="text" name="plat_number"
                               value="{{ old('plat_number') }}"
                               class="form-control form-control-sm">
                        @error('plat_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- DATE -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Date</label>
                        <input type="date" name="created_at"
                               value="{{ old('created_at') }}"
                               class="form-control form-control-sm">
                    </div>

                    <!-- ATTACHMENT -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Attachment</label>
                        <input type="file" name="attached"
                               class="form-control form-control-sm">
                    </div>
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-end mt-5 gap-2">
                    <button type="reset" class="btn btn-outline-danger btn-sm">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-success btn-sm px-4">
                        Save <i class="bi bi-check-circle ms-1"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>
    
    @endif

    <!-- ===================== -->
    <!-- TRANSACTION TABLE -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm rounded mt-2">
        <div class="card-body">

            <!-- Table Header -->
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h6 class="fw-semibold text-uppercase mb-0">Transaction List</h6>

                <form method="GET" class="d-flex">
                    <input type="text" name="search"
                           value="{{ $search ?? '' }}"
                           class="form-control form-control-sm me-2"
                           placeholder="Search DO, SO, Client...">
                    <button class="btn btn-sm btn-primary">Search</button>
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle table-striped"
                       style="font-size:10px">
                    <thead class="table-dark text-secondary text-uppercase small" style="color: white !important;">
                        <tr>
                            <th>#</th>
                            <th>DO</th>
                            <th>SO</th>
                            <th>LO</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Driver</th>
                            <th>Qty (L)</th>
                            <th>Request</th>
                            <th>Status</th>
                            <th>Plat</th>
                            <th>Attachment</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $key => $tx)
                        <tr class="{{ !$tx->status ? 'table-warning' : '' }}">
                            <td>{{ $transactions->firstItem() + $key }}</td>
                            <td class="fw-bold">{{ $tx->do_number }}</td>
                            <td>{{ $tx->so_number }}</td>
                            <td>{{ $tx->lo_number }}</td>
                            <td>{{ $tx->product_name."/".$tx->quality }}</td>
                            <td>{{ $tx->client_name }}</td>
                            <td>{{ $tx->driver_name }}</td>
                            <td>{{ number_format($tx->quantity,2,',','.') }}</td>
                            <td>

                                @if ($tx->statusedit==true && Auth::user()->roles==='staff')
                                <i class="bi bi-unlock text-danger"></i>
                                @else
                                <form action="{{ route('statusedit',['id'=>$tx->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <button class="btn btn-success btn-sm">
                                    <i class="bi bi-lock"></i>
                                </button>
                                </form>
                                    
                                @endif
                                
                            </td>
                            <td>
                                <span class="badge {{ $tx->status ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $tx->status ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $tx->plat_number }}</td>

                            <!-- ATTACHMENT -->
                            <td class="text-center">
                                @if($tx->attached)
                                    <a href="{{ asset('storage/'.$tx->attached) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary"
                                       title="View Attachment">
                                        <i class="bi bi-paperclip"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($tx->created_at)->translatedFormat('d M Y H:i') }}
                            </td>

                           

                            <!-- ACTION -->
                            <td class="text-end">
                                @if(Auth::user()->roles==='staff')
                                
                                
                                @else
                                <a href="{{ route('transaction.edit',$tx->id) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('transaction.destroy',$tx->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this transaction?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                
                                @endif

                                @if($tx->status)
                                    <a href="{{ route('transaction.print',$tx->id) }}"
                                       class="btn btn-sm btn-secondary ms-1">
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
