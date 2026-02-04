@extends('Master.Master')
@section('title','Summary')
@section('content')



<div class="container-fluid px-4">

    {{-- FILTER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label class="form-label small text-muted">Start Date</label>
                        <input type="date" name="start_date"
                               value="{{ request('start_date') }}"
                               class="form-control form-control-sm rounded-3">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small text-muted">End Date</label>
                        <input type="date" name="end_date"
                               value="{{ request('end_date') }}"
                               class="form-control form-control-sm rounded-3">
                    </div>

                    <div class="col-md-6 text-end">
                        <button class="btn btn-dark btn-sm rounded-pill px-4">
                            Filter
                        </button>

                        <a href="{{ route('transaction.index') }}"
                           class="btn btn-light btn-sm rounded-pill px-4 ms-2">
                            Reset
                        </a>

                        <a href="{{ route('summary.excel', request()->query()) }}"
                           class="btn btn-success btn-sm rounded-pill px-4 ms-2">
                            Export Excel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm rounded-4" style="font-size: 10px;">
        <div class="card-header bg-white border-0">
            <h6 class="mb-0 fw-semibold">Delivery Order Report</h6>
            <small class="text-muted">
                @if(request('start_date') && request('end_date'))
                    {{ request('start_date') }} → {{ request('end_date') }}
                @else
                    All Data
                @endif
            </small>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>DO Nu.</th>
                            <th>Client Name</th>
                            <th>LO Nu.</th>
                            <th>Gasolina (L)</th>
                            <th>Gasole (L)</th>
                            <th>Jet-A1 (L)</th>
                            <th>Payment Reference</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $i => $t)
                            <tr style="font-size: 10px;">
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $t->do_number }}</td>
                                <td>{{ $t->client_name }}</td>
                                <td>{{ $t->lo_number }}</td>

                                <td class="text-end">
                                    {{ $t->product_name === 'GASOLINA' ? format_liter($t->quantity,2) : '-' }}
                                </td>

                                <td class="text-end">
                                    {{ $t->product_name === 'GASOLEO' ? format_liter($t->quantity,2) : '-' }}
                                </td>

                                <td class="text-end">
                                    {{ $t->product_name === 'JET-A1' ? format_liter($t->quantity,2) : '-' }}
                                </td>

                                <td>{{ $t->payment_reference ?? '-' }}</td>
                                <td>{{ $t->description ?? '-' }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($t->created_at)->format('d-m-Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    No data found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    {{-- TOTAL --}}
                    @if($transactions->count())
                    <tfoot class="table-light fw-semibold">
                        <tr>
                            <td colspan="4" class="text-end">TOTAL</td>
                            <td class="text-end">
                                {{ number_format($transactions->filter(fn($t) => strtoupper($t->product_name) === 'GASOLINA')->sum('quantity'),2) }}
                            </td>
                            <td class="text-end">
                                {{ number_format($transactions->filter(fn($t) => strtoupper($t->product_name) === 'GASÓLEO')->sum('quantity'),2) }}
                            </td>
                            <td class="text-end">
                                {{ number_format($transactions->filter(fn($t) => strtoupper($t->product_name) === 'JET-A1')->sum('quantity'),2) }}
                            </td>
                            <td colspan="3"></td>
                        </tr>
                   
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>

    
@endsection