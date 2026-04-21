@extends('Master.Master')
@section('title','Report')

@section('content')
<div class="container-fluid py-3">

    {{-- ================= HEADER SECTION ================= --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

            <h5 class="mb-0 fw-semibold text-dark">
                Transaction Report
            </h5>

            {{-- ===== FILTER ETO (RIGHT SIDE) ===== --}}
            <div class="d-flex align-items-center gap-3">

                <span class="fw-semibold text-muted">Filter ETO</span>

                <form action="{{ route('checklist.toggle',['id'=>1]) }}" method="POST">
                    @csrf

                    @if($btn == 1)
                        <input type="hidden" name="status_check" value="0">

                        <button type="submit"
                            class="btn btn-success px-4 shadow-sm rounded-pill">
                            <i class="bi bi-power"></i> ON
                        </button>
                    @else
                        <input type="hidden" name="status_check" value="1">

                        <button type="submit"
                            class="btn btn-outline-danger px-4 shadow-sm rounded-pill">
                            <i class="bi bi-power"></i> OFF
                        </button>
                    @endif
                </form>

            </div>
        </div>
    </div>


    {{-- ================= FILTER FORM ================= --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <form method="GET"
                  action="{{ route('transactions.report') }}"
                  class="row g-3 align-items-end">

                <div class="col-md-2">
                    <label class="form-label small text-muted">From Date</label>
                    <input type="date" name="from"
                           value="{{ request('from') }}"
                           class="form-control form-control-sm">
                </div>

                <div class="col-md-2">
                    <label class="form-label small text-muted">To Date</label>
                    <input type="date" name="to"
                           value="{{ request('to') }}"
                           class="form-control form-control-sm">
                </div>

                <div class="col-md-2">
                    <label class="form-label small text-muted">Client</label>
                    <select name="client" class="form-select form-select-sm">
                        <option value="all">All</option>
                        @foreach($clients as $c)
                            <option value="{{ $c->id }}"
                                {{ request('client')==$c->id?'selected':'' }}>
                                {{ $c->client_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small text-muted">Product</label>
                    <select name="product" class="form-select form-select-sm">
                        <option value="all">All</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}"
                                {{ request('product')==$p->id?'selected':'' }}>
                                {{ $p->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
  

    <div class="d-flex flex-wrap gap-2">

        <button type="submit"
                class="btn btn-primary btn-sm shadow-sm">
            <i class="bi bi-search"></i> Filter
        </button>

        <a href="{{ route('transactions.report.pdf', request()->all()) }}"
           target="_blank"
           class="btn btn-danger btn-sm shadow-sm">
            <i class="bi bi-file-pdf-fill text-white"></i> PDF
        </a>

        <a href="{{ route('transactions.report.excel', request()->all()) }}"
           class="btn btn-success btn-sm shadow-sm">
             <i class="bi bi-file-earmark-spreadsheet-fill"></i>  EXEL
        </a>

        <a href="{{ route('transactions.report.qdb') }}"
           class="btn btn-success btn-sm shadow-sm">
            QDB Export
        </a>

    </div>
</div>

            

            </form>

        </div>
    </div>


    {{-- ================= SUMMARY CARDS ================= --}}
    @if($totalPerProduct->isNotEmpty())
    <div class="row mb-4">

        @foreach($totalPerProduct as $t)
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body">
                    <div class="fw-semibold text-dark small">
                        {{ $t['product'] }}
                    </div>
                    <div class="fw-bold text-primary fs-5">
                        {{ format_liter($t['total']) }}
                    </div>
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow bg-success text-white h-100 text-center">
                <div class="card-body">
                    <div class="fw-semibold small">
                        All Products
                    </div>
                    <div class="fw-bold fs-5">
                        {{ format_liter($totalOverall,2) }}
                    </div>
                    <small>Total Overall</small>
                </div>
            </div>
        </div>

    </div>
    @endif


    {{-- ================= TRANSACTION TABLE ================= --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
    <div class="mt-3">
        {{ $transactions->links() }}
    </div>

            <table class="table table-hover table-bordered align-middle mb-0"
                   style="font-size: 11px;">

                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>LO</th>
                        <th>DO</th>
                        <th>SO</th>
                        <th>Client</th>
                        <th>Product</th>
                        <th>Qty (L)</th>
                        <th>Driver</th>
                        <th>Plat</th>
                        <th>File</th>
                        <th>Payment Ref</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $index => $t)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td>{{ $t->lo_number }}</td>
                        <td>{{ $t->do_number }}</td>
                        <td>{{ $t->so_number }}</td>
                        <td>{{ $t->client_name }}</td>
                        <td>{{ $t->product_name }}</td>
                        <td class="text-end">{{ number_format($t->quantity,2) }}</td>
                        <td>{{ $t->driver_name }}</td>
                        <td>{{ $t->plat_number }}</td>

                        <td class="text-center">
                            @if($t->attached)
                                <a href="{{ asset('storage/'.$t->attached) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary rounded-circle">
                                    <i class="bi bi-paperclip"></i>
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="small">{{ $t->payment_references }}</td>
                        <td class="small">{{ $t->description }}</td>

                        <td class="text-center">
                            @if($t->status)
                                <span class="badge bg-success px-3">Completed</span>
                            @else
                                <span class="badge bg-warning text-dark px-3">Pending</span>
                            @endif
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($t->created_at)->format('d M Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="text-center py-4 text-muted">
                            No transactions found
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

   

</div>
@endsection
