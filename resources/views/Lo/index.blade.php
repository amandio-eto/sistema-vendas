@extends('Master.Master')
@section('title','content')
@section('content')

<div class="container-fluid">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">LO Report</h4>
            <small class="text-muted">Monitoring LO Jump & Unregistered</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('lo.pdf', request()->query()) }}"
               class="btn btn-danger btn-sm">
                <i class="bi bi-file-earmark-pdf"></i> PDF
            </a>

            <a href="{{ route('lo.excel', request()->query()) }}"
               class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel"></i> Excel
            </a>
        </div>
    </div>

    {{-- ================= FILTER ================= --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('lo.index') }}" class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label small text-muted">Start Date</label>
                    <input type="date"
                           name="from"
                           class="form-control form-control-sm"
                           value="{{ request('from') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label small text-muted">End Date</label>
                    <input type="date"
                           name="to"
                           class="form-control form-control-sm"
                           value="{{ request('to') }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-funnel"></i> Filter
                    </button>

                    <a href="{{ route('lo.index') }}"
                       class="btn btn-outline-secondary btn-sm">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="40">No</th>
                            <th>SO</th>
                            <th>LO</th>
                            <th>LO Jump</th>
                            <th>LO Unregister</th>
                            <th>Client</th>
                            <th class="text-end">Quantity</th>
                            <th>Product</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($los as $i => $t)
                        <tr>
                            <td class="text-center">
                                {{ $los->firstItem() + $i }}
                            </td>

                            <td>{{ $t->so_number }}</td>

                            <td class="fw-bold text-center">
                                {{ $t->lo_number }}
                            </td>

                            <td class="text-center">
                                @if($t->lo_jump)
                                    <span class="badge bg-warning text-dark">
                                        {{ $t->lo_jump }}
                                    </span>
                                @else
                                    <span class="badge bg-success">OK</span>
                                @endif
                            </td>

                            <td>
                                @if(count($t->lo_missing))
                                    <span class="text-danger fw-semibold">
                                        {{ implode(', ', $t->lo_missing) }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ $t->client_name }}</td>

                            <td class="text-end">
                                {{ number_format($t->quantity, 0) }}
                            </td>

                            <td>{{ $t->product_name }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($t->created_at)->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                No data found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= PAGINATION ================= --}}
        <div class="card-footer bg-white py-2">
            {{ $los->withQueryString()->links() }}
        </div>
    </div>

</div>




    
@endsection