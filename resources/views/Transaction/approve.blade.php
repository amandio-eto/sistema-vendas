@extends('Master.Master')
@section('title','Transactions')

@section('content')
<div class="container-fluid px-4">

    <!-- ===================== -->
    <!-- Transaction Table -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm rounded mt-2">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h6 class="fw-semibold text-uppercase mb-0">DELIVERY ORDER </h6>

                <!-- Search -->
                <form method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control form-control-sm me-2" placeholder="Search DO, SO, client...">
                    <button class="btn btn-sm btn-primary">Search</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 table-striped table-bordered rounded shadow-sm">
                    <thead class="text-uppercase small" style="background: linear-gradient(90deg, #e3f2fd, #bbdefb);">
                        <tr>
                            <th>#</th>
                            <th>DO</th>
                            <th>SO</th>
                            <th>LO</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Driver</th>
                            <th>Quantity</th>
                            <th>Approve</th>
                            <th>Authorized</th>
                            <th>Plat</th>
                            <th>Request</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $key => $tx)
                            <tr class="{{ $tx->status ? '' : 'table-warning' }} align-middle">
                                <td>{{ $transactions->firstItem() + $key }}</td>
                                <td class="fw-bold">{{ $tx->do_number }}</td>
                                <td>{{ $tx->so_number }}</td>
                                <td>{{ $tx->lo_number }}</td>
                                <td>{{ $tx->product_name }}</td>
                                <td>{{ $tx->client_name }}</td>
                                <td>{{ $tx->driver_name }}</td>
                                <td>{{  format_liter($tx->quantity) }}</td>
                                <td>

                                    @if($tx->statusedit==true)

                                   <form action="{{ route('approveupdate', ['id' => $tx->tdi]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                   <button type="submit" class="btn btn-sm btn-warning shadow-sm" >
                                         <i class="bi bi-pen"></i> APPROVED EDIT
                                   </button>
                                   </form>
                                    @else
                                     <form action="{{ route('transaction.approvededit', ['id' => $tx->tdi]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                   <button type="submit" class="btn btn-sm btn-success shadow-sm" >
                                         <i class="bi bi-check"></i> APPROVED
                                   </button>
                                   </form>

                                    @endif
                                  






                                     
                                </td>
                                <td>{{ $tx->authorized_by ?? '-' }}</td>
                                <td>{{ $tx->plat_number }}</td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-success shadow-sm">
                                        <i class="bi bi-file-lock"></i>
                                    </button>
                                </td>
                                <td class="text-muted">{{ \Carbon\Carbon::parse($tx->created_at)->translatedFormat('d M Y H:i') }}</td>
                                <td class="text-end">
                                   @if(Auth::user()->roles==='administrator')
                                   @else
                                     <a href="{{ route('transaction.edit', $tx->id) }}" class="btn btn-sm btn-warning me-1 shadow-sm" title="Edit Transaction">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('transaction.destroy', $tx->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Delete this transaction?')" title="Delete Transaction">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                  
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
