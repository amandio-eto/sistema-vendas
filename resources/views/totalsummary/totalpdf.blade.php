<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Total Summary Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
        }

        .period {
            text-align: center;
            font-size: 11px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #f2f2f2;
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: right;
        }

        table td:first-child {
            text-align: left;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <strong>Total Summary Report</strong>
    </div>

    <div class="period">
        Period: {{ $start ?? '-' }} s/d {{ $end ?? '-' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ClASSIFICAO</th>
                <th>GASOLINE</th>
                <th>GASÓLEO</th>
                <th>Jet</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandGasoline = 0;
                $grandGasoleo  = 0;
                $grandJet      = 0;
            @endphp

            @foreach($data as $type => $row)
                @php
                    $total = $row['GASOLINA'] + $row['GASÓLEO'] + $row['JET-A1'];
                    $grandGasoline += $row['GASOLINA'];
                    $grandGasoleo  += $row['GASÓLEO'];
                    $grandJet      += $row['JET-A1'];
                @endphp
                <tr>
                    <td>{{ $type }}</td>
                    <td>{{ number_format($row['GASOLINA'],2) }}</td>
                    <td>{{ number_format($row['GASÓLEO'],2) }}</td>
                    <td>{{ number_format($row['JET-A1'],2) }}</td>
                    <td>{{ number_format($total,2) }}</td>
                </tr>
            @endforeach

            <tr style="background:#eaeaea;">
                <td><strong>GRAND TOTAL</strong></td>
                <td>{{ format_liter($grandGasoline,2) }}</td>
                <td>{{ format_liter($grandGasoleo,2) }}</td>
                <td>{{ format_liter($grandJet,2) }}</td>
                <td>
                    {{ number_format($grandGasoline + $grandGasoleo + $grandJet,2) }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Generated at {{ date('d M Y H:i') }} <br>
        Develop By IT Esperanca Timor Oan, lda
    </div>

</body>
</html>
