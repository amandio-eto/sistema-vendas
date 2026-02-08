@extends('Master.Master')

@section('content')
<div class="container-fluid mt-4">

    {{-- ===================== --}}
    {{-- Form Update Stock --}}
    {{-- ===================== --}}
    @if(isset($tank))
    <div class="card mb-4 shadow-sm rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Stock – {{ $tank->tank_name }}</h5>
            <small>Current Stock: {{ number_format($tank->current_stock ?? 0,2) }} / {{ number_format($tank->capacity_tank ?? 0,2) }}</small>
        </div>
        <div class="card-body">
            {{-- Progress bar --}}
            @php
                $percent = $tank->capacity_tank ? ($tank->current_stock / $tank->capacity_tank) * 100 : 0;
            @endphp
            <div class="mb-3">
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                        {{ number_format($percent,1) }}%
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('tank.stock.store', $tank->id) }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control" required>
                            <option value="IN">Stock IN</option>
                            <option value="OUT">Stock OUT</option>
                            <option value="ADJUST">Adjust</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" step="0.01" name="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Note</label>
                        <input type="text" name="note" class="form-control" placeholder="Optional note">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Update Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- ===================== --}}
    {{-- Stock History Table --}}
    {{-- ===================== --}}
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-secondary text-dark">
            <h5 class="mb-0" style="color:white;">Tank Stock History</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Tank</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Before</th>
                        <th>After</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $row)
                    <tr class="text-center">
                        <td>{{ $loop->iteration + ($records->currentPage() - 1) * $records->perPage() }}</td>
                        <td class="text-start">{{ $row->tank_name }}</td>
                        <td class="text-start">{{ $row->product_name }}</td>
                        <td>
                            @if($row->type == 'IN')
                                <span class="badge bg-success">{{ $row->type }}</span>
                            @elseif($row->type == 'OUT')
                                <span class="badge bg-danger">{{ $row->type }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $row->type }}</span>
                            @endif
                        </td>
                        <td>{{ number_format($row->quantity,2) }}</td>
                        <td>{{ number_format($row->stock_before,2) }}</td>
                        <td>{{ number_format($row->stock_after,2) }}</td>
                        <td class="text-start">{{ $row->note }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No stock history yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $records->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
