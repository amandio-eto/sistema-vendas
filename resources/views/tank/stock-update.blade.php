@extends('Master.Master')

@section('content')
<div class="container-fluid">

    {{-- ===================== --}}
    {{-- Form Update Stock --}}
    {{-- ===================== --}}
    @if(isset($tank))
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <div class="card-header bg-gradient-primary text-white rounded-top">
            <h5 class="mb-1">Update Stock – {{ $tank->tank_name ?? '' }} ({{ $tank->product_name ?? '' }})</h5>
            <small class="text-white-50">
                Current Stock: {{ number_format($tank->current_stock ?? 0,2) }} / {{ number_format($tank->capacity_tank ?? 0,2) }}
            </small>
            <div class="progress mt-2" style="height: 8px;">
                @php
                    $percent = ($tank->capacity_tank > 0) ? ($tank->current_stock / $tank->capacity_tank * 100) : 0;
                @endphp
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tank.stock.store', $tank->id) }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="IN" class="text-success">Stock IN (Penambahan)</option>
                          
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="number" step="0.01" name="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Note</label>
                        <input type="text" name="note" class="form-control" placeholder="Optional note">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-success w-100 rounded-3"><i class="bi bi-plus-circle me-1"></i> Update Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="alert alert-danger shadow-sm">Tank not found!</div>
    @endif

    {{-- ===================== --}}
    {{-- Stock History Table --}}
    {{-- ===================== --}}
  

</div>
@endsection
