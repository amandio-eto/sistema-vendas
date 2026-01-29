@extends('Master.Master')
@section('title','Report')

@section('content')
<div class="container">


    <!-- FILTER FORM -->
    <form method="GET" action="{{ route('transactions.report') }}" style="margin-bottom:20px;">
        <div style="display:flex; gap:15px; flex-wrap:wrap; align-items:flex-end;">

            <!-- From Date -->
            <div>
                <label>From Date:</label>
                <input type="date" name="from" value="{{ request('from') }}">
            </div>

            <!-- To Date -->
            <div>
                <label>To Date:</label>
                <input type="date" name="to" value="{{ request('to') }}">
            </div>

            <!-- Client Filter -->
            <div>
                <label>Client:</label>
                <select name="client">
                    <option value="all">All</option>
                    @foreach($clients as $c)
                        <option value="{{ $c->id }}" {{ request('client') == $c->id ? 'selected' : '' }}>
                            {{ $c->client_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Product Filter -->
            <div>
                <label>Product:</label>
                <select name="product">
                    <option value="all">All</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" {{ request('product') == $p->id ? 'selected' : '' }}>
                            {{ $p->product_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>

            <!-- PDF & Excel Export -->
            <div>
                <a href="{{ route('transactions.report.pdf', request()->all()) }}" target="_blank" class="btn btn-danger">PDF</a>
                <a href="{{ route('transactions.report.excel', request()->all()) }}" class="btn btn-success">Excel</a>
            </div>

        </div>
    </form>

    <!-- TRANSACTIONS TABLE -->
    <table class="table table-bordered table-striped" style="font-size: 10px;">
        <thead>
            <tr>
                <th>#</th>
                <th>DO</th>
                <th>SO</th>
                <th>Client</th>
                <th>Product</th>
                <th>Qty (L)</th>
                <th>Qty (Ton)</th>
                <th>Driver</th>
                <th>Plat</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->do_number }}</td>
                <td>{{ $t->so_number }}</td>
                <td>{{ $t->client_name }}</td>
                <td>{{ $t->product_name }}</td>
                <td>{{ number_format($t->quantity) }}</td>
                <td>{{ format_ton($t->quantity) }}</td>
                <td>{{ $t->driver_name }}</td>
                <td>{{ $t->plat_number }}</td>
                <td>{{ $t->status ? 'Completed' : 'Pending' }}</td>
                <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" style="text-align:center;">No transactions found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $transactions->links() }}

</div>
@endsection
