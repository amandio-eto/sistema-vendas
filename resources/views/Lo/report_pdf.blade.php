<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LO Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
        }

        .header small {
            color: #555;
        }

        .meta {
            margin-bottom: 10px;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 4px;
        }

        th {
            background: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        td {
            vertical-align: middle;
        }

        .text-center { text-align: center; }
        .text-right  { text-align: right; }

        .badge-ok {
            background: #28a745;
            color: #fff;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
        }

        .badge-warn {
            background: #ffc107;
            color: #000;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
        }

        .missing {
            color: #c82333;
            font-weight: bold;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #555;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
</head>

<body>

    {{-- ================= HEADER ================= --}}
    <div class="header">
        <h2>LO REPORT</h2>
        <small>LO Jump & Unregistered Monitoring</small>
    </div>

    {{-- ================= META ================= --}}
    <div class="meta">
        <strong>Period:</strong>
        {{ request('from') ?? '-' }}
        &nbsp; to &nbsp;
        {{ request('to') ?? '-' }}

        <span style="float:right">
            Printed: {{ now()->format('d-m-Y H:i') }}
        </span>
    </div>

    {{-- ================= TABLE ================= --}}
    <table>
        <thead>
            <tr>
                <th width="25">No</th>
                <th width="70">SO</th>
                <th width="50">LO</th>
                <th width="55">LO Jump</th>
                <th>LO Unregister</th>
                <th>Client</th>
                <th width="60">Qty</th>
                <th>Product</th>
                <th width="65">Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $i => $t)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $t->so_number }}</td>
                <td class="text-center"><strong>{{ $t->lo_number }}</strong></td>

                <td class="text-center">
                    @if($t->lo_jump)
                        <span class="badge-warn">{{ $t->lo_jump }}</span>
                    @else
                        <span class="badge-ok">OK</span>
                    @endif
                </td>

                <td>
                    @if(count($t->lo_missing))
                        <span class="missing">
                            {{ implode(', ', $t->lo_missing) }}
                        </span>
                    @else
                        -
                    @endif
                </td>

                <td>{{ $t->client_name }}</td>

                <td class="text-right">
                    {{ number_format($t->quantity, 0) }}
                </td>

                <td>{{ $t->product_name }}</td>

                <td class="text-center">
                    {{ \Carbon\Carbon::parse($t->created_at)->format('d-m-Y') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- ================= FOOTER ================= --}}
    <footer>
        Developed by IT Esperanca Timor Oan, Lda |
        Page <span class="page-number"></span>
    </footer>

</body>
</html>
