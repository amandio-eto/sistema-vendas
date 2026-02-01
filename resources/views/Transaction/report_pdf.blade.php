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

<div class="row">
    <div class="col">
        <h2 style="text-align:center;">Daily Sales Report <br>
            <span>Parque de Armazenamento de Combustíveis Hera (PAC-Hera)</span>
        </h2>
       


    </div>
</div>



<table style="font-size: 8px;">
    <thead>
        <tr>
            <th>N <sup> <u>0</u> </sup></sub></th>
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
            <th>{{ $t->lo_number }}</th>
            <td>{{ $t->do_number }}</td>
            <td>{{ $t->so_number }}</td>
            <td>{{ $t->client_name }}</td>
            <td>{{$t->product_name }}</td>
            <td>
                {{  "#".$t->cp }}
                
            </td>
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

<p style="text-align:center; margin-top:20px;">
    e-ETO | Developed by IT Esperanca Timor Oan, lda | {{ \Carbon\Carbon::now()->format('Y') }}
</p>

</body>
</html>
