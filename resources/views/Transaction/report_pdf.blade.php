<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transactions Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size:12px; color:#333; }
        table { width:100%; border-collapse: collapse; margin-top:10px; }
        table th, table td { border:1px solid #ccc; padding:6px; text-align:left; }
        table th { background:#f8f8f8; }
        .status { padding:2px 6px; border-radius:4px; color:#fff; font-weight:bold; }
        .status.completed { background:#4caf50; }
        .status.pending { background:#ff9800; }
        h4 { margin-bottom:6px; }
        .summary-table { width:45%; font-size:9px; border-collapse:collapse; margin-bottom:15px; }
        .summary-table th, .summary-table td { border:none; padding:4px 2px; }
        .summary-table th { border-bottom:1px solid #000; }
        .summary-table tr.total td, .summary-table tr.total th { border-top:1px solid #000; font-weight:bold; }
        .right { text-align:right; }
    </style>
</head>
<body>

<div style="text-align:center; margin-bottom:10px;">
    <h2>Daily Sales Report<br>
        <span>Parque de Armazenamento de Combustíveis Hera (PAC-Hera)</span>
    </h2>
</div>

@php
    // Hitung total per product & grand total
    $totalPerProduct = [];
    $grandTotal = 0;
    foreach($transactions as $t){
        $totalPerProduct[$t->product_name] = ($totalPerProduct[$t->product_name] ?? 0) + $t->quantity;
        $grandTotal += $t->quantity;
    }
@endphp

<!-- SUMMARY PRODUCT -->
<h4>SUMMARY PRODUCT</h4>
<table class="summary-table">
    <thead>
        <tr>
            <th>Product</th>
            <th class="right">Total (L)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($totalPerProduct as $product => $total)
        <tr>
            <td>{{ $product }}</td>
            <td class="right">{{ number_format($total,0,',','.') }} L</td>
        </tr>
        @endforeach
        <tr class="total">
            <th class="right">TOTAL PRODUCT</th>
            <th class="right">{{ number_format($grandTotal,0,',','.') }} L</th>
        </tr>
    </tbody>
</table>

<!-- TRANSACTIONS TABLE -->
<table style="font-size: 8px;">
    <thead>
        <tr>
            <th>N<sup>0</sup></th>
            <th>LO</th>
            <th>DO</th>
            <th>SO</th>
            <th>Client</th>
            <th>Product</th>
            <th>Code Product</th>
            <th>Qty (L)</th>
            <th>Driver</th>
            <th>Plat</th>
            <th>Payment References</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $index => $t)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $t->lo_number }}</td>
            <td>{{ $t->do_number }}</td>
            <td>{{ $t->so_number }}</td>
            <td>{{ $t->client_name }}</td>
            <td>{{ $t->product_name }}</td>
            <td>#{{ $t->cp }}</td>
            <td>{{ number_format($t->quantity) }}</td>
            <td>{{ $t->driver_name }}</td>
            <td>{{ $t->plat_number }}</td>
            <td style="font-size: 8px;">{{ $t->payment_references }}</td>
            <td style="font-size: 6px;">{{ $t->description }}</td>
            <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d M Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- FOOTER -->
<p style="text-align:center; margin-top:20px;">
    e-ETO | Developed by IT Esperanca Timor Oan, lda | {{ \Carbon\Carbon::now()->format('Y') }}
</p>

</body>
</html>
