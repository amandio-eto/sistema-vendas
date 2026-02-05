@extends('Master.Master')
@section('title','Report')

@section('content')
<div class="m-3">

    <!-- FILTER FORM -->
    <form method="GET" action="{{ route('transactions.report') }}" class="mb-3 d-flex flex-wrap gap-3 align-items-end">
        <div>
            <label>From Date:</label>
            <input type="date" name="from" value="{{ request('from') }}">
        </div>
        <div>
            <label>To Date:</label>
            <input type="date" name="to" value="{{ request('to') }}">
        </div>
        <div>
            <label>Client:</label>
            <select name="client">
                <option value="all">All</option>
                @foreach($clients as $c)
                    <option value="{{ $c->id }}" {{ request('client')==$c->id?'selected':'' }}>{{ $c->client_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Product:</label>
            <select name="product">
                <option value="all">All</option>
                @foreach($products as $p)
                    <option value="{{ $p->id }}" {{ request('product')==$p->id?'selected':'' }}>{{ $p->product_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div>
            <a href="{{ route('transactions.report.pdf', request()->all()) }}" target="_blank" class="btn btn-danger">PDF</a>
            <a href="{{ route('transactions.report.excel', request()->all()) }}" class="btn btn-success">Excel</a>
        </div>
    </form>
    <hr>

    <!-- TOTAL PER PRODUCT -->
    @if($totalPerProduct->isNotEmpty())
    <div class="mb-3 d-flex flex-wrap gap-3">
        @foreach($totalPerProduct as $t)
        <div class="card border-0 shadow-sm p-3" style="min-width:150px;">
            <div class="fw-semibold">{{ $t['product'] }}</div>
            <div class="text-primary fw-bold" style="font-size:18px;">{{ format_liter($t['total']) }}</div>
            <small class="text-muted">Total</small>
        </div>
        @endforeach
        <div class="card border-0 shadow-sm p-3 bg-success text-white" style="min-width:150px;">
            <div class="fw-semibold">All Products</div>
            <div class="fw-bold" style="font-size:18px;">{{ format_liter($totalOverall,2) }}</div>
            <small>Total Overall</small>
        </div>
    </div>
    @endif

    <hr>
    <!-- TRANSACTIONS TABLE -->
    <table class="table table-bordered table-striped" style="font-size: 9px;">
        <thead>
            <tr>
                <th>N<sup>0</sup></th>
                <th>LO</th>
                <th>DO</th>
                <th>SO</th>
                <th>Client</th>
                <th>Product</th>
                <th>Qty (L)</th>
                <th>Driver</th>
                <th>Plat</th>
                <th>Attached</th>
                <th>Payment References</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $t)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $t->lo_number }}</td>
                <td>{{ $t->do_number }}</td>
                <td>{{ $t->so_number }}</td>
                <td>{{ $t->client_name }}</td>
                <td>{{ $t->product_name }}</td>
                <td>{{ number_format($t->quantity,2) }}</td>
                <td>{{ $t->driver_name }}</td>
                <td>{{ $t->plat_number }}</td>
                <td class="text-center">
                    @if($t->attached)
                        <a href="{{ asset('storage/'.$t->attached) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="View Attachment">
                            <i class="bi bi-paperclip"></i>
                        </a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td style="font-size:8px;">{{ $t->payment_references }}</td>
                <td style="font-size:8px;">{{ $t->description }}</td>
                <td>{{ $t->status ? 'Completed':'Pending' }}</td>
                <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="14" class="text-center">No transactions found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $transactions->links() }}
</div>
@endsection
