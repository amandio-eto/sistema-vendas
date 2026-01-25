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
    </style>
</head>
<body>

<h2 style="text-align:center;">Transactions Report</h2>
<p>ESPERACA TIMOR OAN,LDA</p>

<table>
    <thead>
        <tr>
            <th>N <sup> <u>0</u> </sup></sub></th>
            <th>DO</th>
            <th>SO</th>
            <th>Client</th>
            <th>Product</th>
            <th>Code Product</th>
            <th>Type Product</th>
            <th>Qty (L)</th>
            <th>Qty (Ton)</th>
            <th>Driver</th>
            <th>Plat</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $index => $t)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $t->do_number }}</td>
            <td>{{ $t->so_number }}</td>
            <td>{{ $t->client_name }}</td>
            <td>{{$t->product_name }}</td>
            <td>
                {{  "#".$t->cp }}
                
            </td>
            <td>{{  "#".$t->q }}</td>
            <td>{{ number_format($t->quantity) }}</td>
            <td>{{ format_ton($t->quantity) }}</td>
            <td>{{ $t->driver_name }}</td>
            <td>{{ $t->plat_number }}</td>
            <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d M Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p style="text-align:center; margin-top:20px;">
    e-ETO | Developed by IT Esperanca Timor Oan, lda | {{ \Carbon\Carbon::now()->format('Y') }}
</p>

</body>
</html>
