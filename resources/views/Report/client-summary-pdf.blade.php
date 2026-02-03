<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Client Summary Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f0f0f0;
            text-align: center;
            padding: 6px;
        }
        td {
            text-align: center;
            padding: 6px;
        }
        tfoot td {
            font-weight: bold;
        }
        .text-left {
            text-align: left;
        }
        .footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            font-size: 10px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h2>Client Summary Report</h2>
        @if($request->start_date && $request->end_date)
            <p>From: {{ $request->start_date }} To: {{ $request->end_date }}</p>
        @endif
        @if($request->client_name)
            <p>Client: {{ $request->client_name }}</p>
        @endif
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Client Name</th>
                <th>RON98</th>
                <th>RON92</th>
                <th>10PPM</th>
                <th>JET-A1</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalRON98 = 0;
                $totalRON92 = 0;
                $total10PPM = 0;
                $totalJET_A1 = 0;
            @endphp
            @forelse($summaryData as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-left">{{ $row->client_name }}</td>
                    <td>{{ number_format($row->ron98, 2) }}</td>
                    <td>{{ number_format($row->ron92, 2) }}</td>
                    <td>{{ number_format($row->ppm10, 2) }}</td>
                    <td>{{ number_format($row->jeta1, 2) }}</td>
                </tr>

                @php
                    $totalRON98 += $row->ron98;
                    $totalRON92 += $row->ron92;
                    $total10PPM += $row->ppm10;
                    $totalJET_A1 += $row->jeta1;
                @endphp
            @empty
                <tr>
                    <td colspan="6">No Data Available</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">TOTAL</td>
                <td>{{ number_format($totalRON98, 2) }}</td>
                <td>{{ number_format($totalRON92, 2) }}</td>
                <td>{{ number_format($total10PPM, 2) }}</td>
                <td>{{ number_format($totalJET_A1, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Developed by IT Esperanca Timor Oan, lda
    </div>

</body>
</html>
