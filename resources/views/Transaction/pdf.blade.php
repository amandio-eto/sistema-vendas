<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery Order #{{ $transaction->tdi }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color:#333; margin:0; padding:0; font-size:12px; }
        .container { width:95%; margin:auto; padding:10px 0; }

        /* HEADER */
        header { display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; }
        header img.logo { height:50px; }
        header img.qrcode { height:70px; }
        header h2 { margin:0; text-align:center; flex:1; font-size:18px; color:black; }

        /* COMPANY & CLIENT INFO */
        .info { display:flex; justify-content:space-between; gap:10px; margin-bottom:10px; }
        .info div { flex:1; border:1px solid #ccc; padding:8px; border-radius:4px; }
        .info h4 { margin:0 0 5px 0; color:#555; font-size:13px; }

        /* PRODUCT TABLE */
        table { width:100%; border-collapse: collapse; margin-top:5px; }
        table th, table td { border:1px solid #ccc; padding:5px; text-align:left; font-size:12px; }
        table th { background-color:#f8f8f8; }
        table tr:nth-child(even) td { background-color:#fdfdfd; }

        /* STATUS */
        .status { font-weight:bold; color:#fff; padding:3px 6px; border-radius:4px; display:inline-block; font-size:12px; }
        .status.pending { background-color:#ff9800; }
        .status.completed { background-color:#4caf50; }

        /* SIGNATURE */
        .signature-table th, .signature-table td { border:none; text-align:center; padding:8px; font-size:12px; }
        .signature-box { height:60px; border-bottom:1px solid #000; margin-bottom:5px; width:80%; margin:auto; }

        /* FOOTER */
        footer { text-align:center; font-size:11px; margin-top:15px; color:#777; }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER -->
    <header>
        <img src="{{ public_path('eto.jpeg') }}" alt="Logo" class="logo">
        <h2>Delivery Order #{{ $transaction->tdi }}</h2>
       
    </header>

    <!-- FROM & TO (Satu Row, Dua Kolom) -->
    <div class="info">
        <!-- FROM -->
        <div>
            <h4>From:</h4>
            Esperanca Timor Oan,Lda <br>
            PAAKH <br>
            Phone: +670 77027766 <br>
            Email: info@eto.tl
        </div>
        <!-- TO -->
        <div>
            <h4>To:</h4>
            {{ $transaction->client_name }} <br>
            Phone: {{ $transaction->phone ?? '-' }} <br>
            Email: {{ $transaction->email ?? '-' }} <br>
            Address: {{ $transaction->address ?? '-' }}
        </div>
    </div>

    <!-- PRODUCT DETAIL TABLE -->
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Code</th>
                <th>Quantity (L)</th>
                <th>Quantity (Ton)</th>
                <th>Driver</th>
                <th>Plat Number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaction->product_name }} / {{ $transaction->q }}</td>
                <td>#{{ $transaction->cp }}</td>
                <td>{{ number_format($transaction->quantity) }} L</td>
                <td>{{ format_ton($transaction->quantity) }}</td>
                <td>{{ $transaction->driver_name }}</td>
                <td>{{ $transaction->plat_number }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ADDITIONAL INFO -->
    <table>
        <tr>
            <th>DO Number</th>
            <td>{{ $transaction->do_number }}</td>
            <th>SO Number</th>
            <td>#{{ $transaction->so_number }}</td>
        </tr>
        <tr>
            <th>Authorization Code</th>
            <td>{{ $transaction->approve_number }}</td>
            <th>Authorized By</th>
            <td>{{ $transaction->authorized_by }} / {{ $transaction->approved }}</td>
        </tr>
        <tr>
            <th>Teller</th>
            <td>{{ $transaction->user_name }}</td>
            <th>Status</th>
            <td>
                <span class="status {{ $transaction->status ? 'completed' : 'pending' }}">
                    {{ $transaction->status ? 'Completed' : 'Pending' }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- SIGNATURE -->
    <table class="signature-table" style="margin-top:20px; width:100%;" border="1">
        <tr>
            <th>Received By</th>
            <th>Authorized Signature</th>
        </tr>
        <tr >
            <td>
                <div class="signature-box"></div>
                (Fullname)
            </td>
            <td>
                <div class="signature-box"></div>
                (Signature)
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <footer>
      This document is officially generated by the electronic system of Esperanca Timor Oan, lda to ensure authenticity for all clients. | Thanks .. {{ \Carbon\Carbon::now()->format('Y') }}
    </footer>

</div>
</body>
</html>
