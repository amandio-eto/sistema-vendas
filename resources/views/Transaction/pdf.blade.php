<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery Order #{{ $transaction->tdi }}</title>
     <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('apple-icon.png') }}">
    
    <style>
        body { font-family: DejaVu Sans, sans-serif; color:#333; margin:0; padding:0; font-size:12px; }
        .container { width:95%; margin:auto; padding:10px 0;
              text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
              
        
        }

        /* HEADER */
        header { display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; }
        header img.logo { height:50px; }
        header img.qrcode { height:70px; }
        header h2 { margin:0; text-align:center; flex:1; font-size:18px; color:black; }

        /* .info { display:flex; justify-content:space-between; gap:10px; margin-bottom:10px; }
        .info div { flex:1; border:1px solid #ccc; padding:8px; border-radius:4px; }
        .info h4 { margin:0 0 5px 0; color:#555; font-size:13px; } */

             .info {
                font-size: 8px;
                line-height: 1.4;
                margin: 0;
            }

            .info strong {
                font-weight: 600;
                font-size: 8px;
                text-transform: uppercase;
                display: inline-block;
                margin-bottom: 2px;
            }

            .info .col-6 {
                padding-left: 6px;
                padding-right: 6px;
            }

.info .col-6:first-child {
    border-right: 1px solid #e5e5e5;
}


        /* PRODUCT TABLE */
        table { width:100%; border-collapse: collapse; margin-top:5px; 
          border:1px solid #000;
          text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
        }
        table th, table td { border:1px solid #ccc; padding:5px; text-align:left; font-size:12px; 
            text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
          border:1px solid #000;}
        table th { background-color:#f8f8f8; 
            text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
          border:1px solid #000;}
        table tr:nth-child(even) td { background-color:#fdfdfd;
            text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
              border:1px solid #000;
        
        }

        /* STATUS */
         .status { font-weight:bold; color:#fff; padding:3px 6px; border-radius:4px; display:inline-block; font-size:12px; }
         .status.pending { background-color:#ff9800; }
        .status.completed { background-color:#4caf50; }

        /* SIGNATURE */
        .signature-table th, .signature-table td { border:none; text-align:center; padding:8px; font-size:12px; }
        .signature-box { height:60px; border-bottom:1px solid #000; margin-bottom:5px; width:80%; margin:auto; }
        .logo {
                display: block;
                margin-left: 0;        /* pindah ke kiri */
                margin-right: auto;   /* pastikan tidak ke tengah */
                width: 120px;         /* ukuran logo ideal */
                height: auto;         /* jaga rasio gambar */
                object-fit: contain;
            }
            .logo-wrap {
    text-align: left !important;
}

        .logo-wrap img {
            width: 189px;
            height: 113.9px;
            margin-bottom: 100px;
            display: inline-block;
        }

        /* FOOTER */
        footer { text-align:center; font-size:11px; margin-top:15px; color:#777; } */ */ */
    </style>
</head>
<body>

    <div class="row">
        <div class="col">
            @php
            $doNumber = (string) $transaction->do_number.$transaction->id.$transaction->lo_number; // pastikan string
            $barcode = DNS1D::getBarcodePNG($doNumber, 'C128', 1.5, 50); // lebih kecil
        @endphp

        <div style="position:absolute; top:10px; right:10px; text-align:center;">
            <img src="data:image/png;base64,{{ $barcode }}" 
                style="width:210px; height:30px; display:block; margin:0 auto;">
            <div style="font-size:14px; font-weight:100; margin-top:2px;">
                {{ $doNumber }}
            </div>
</div>
        </div>
    </div>
<div class="container">

    <!-- HEADER -->

    
    <div class="logo-wrap">
    <img src="{{ public_path('LOGOETO.png') }}">
</div>
    <header>
  

        <h2 style="text-align:center;
                font-size:14px;
                font-weight:600;
                padding:6px;">{{ Str::upper('Delivery Order') }}#{{ $transaction->do_number }}</h2>
       
    </header>
    <hr>





  
    
   

<table class="signature-table" style="
    margin-top:30px;
    width:100%;
    border-collapse:collapse;
    font-size:8px;
    text-align:left;
">
    <thead>
        <tr>
            <th style="
                text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
                border:1px solid #000;
            ">
                Fornecedor
            </th>
            <th style="
                text-align:center;
                font-size:12px;
                font-weight:600;
                padding:6px;
                border:1px solid #000;
            ">
                Comprador
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="
                text-align:left;
                padding:8px;
                border:1px solid #000;
                line-height:1.5;
                vertical-align:top;
                 font-size:11px;
                font-weight:600;
                padding:6px;
            ">
                <span style="font-size: 10px">{{ Str::upper('parque de armazenamento de combustível hera') }} (PAC-HERA)</span><br>
                Tin: 1052139<br>
                Email: info@eto.tl
            </td>

            <td style="
                 text-align:left;
                padding:8px;
                border:1px solid #000;
                line-height:1.5;
                vertical-align:top;
                 font-size:11px;
                font-weight:600;
                padding:6px;
            ">
                {{ Str::upper($transaction->client_name) }}<br>
                Phone: {{ $transaction->phone ?? '-' }}<br>
                Email: {{ $transaction->email ?? '-' }}<br>
                Enderesso: {{ $transaction->address ?? '-' }}
            </td>
        </tr>
    </tbody>
</table>


 




    <!-- PRODUCT DETAIL TABLE -->
   <table style="width:100%; border-collapse:collapse; border:1px dotted #000; margin-top:10px;">
    <thead>
        <tr>
             <th style="border:1px dotted #000; padding:6px;">Número LO</th>
              <th style="border:1px dotted #000; padding:6px;">Número de Matrícula</th>
            <th style="border:1px dotted #000; padding:6px;">Produto</th>
                <th style="border:1px dotted #000; padding:6px;">Quantidade (L)</th>
            <th style="border:1px dotted #000; padding:6px;">Número Codigo</th>

            <th style="border:1px dotted #000; padding:6px;">Motorista</th>
           
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border:1px dotted #000; padding:6px;">{{ $transaction->lo_number }}</td>
               <td style="border:1px dotted #000; padding:6px;">{{ $transaction->plat_number }}</td>
            <td style="border:1px dotted #000; padding:6px;">{{ $transaction->product_name }}</td>
              <td style="border:1px dotted #000; padding:6px;">{{ number_format($transaction->quantity) }} L</td>
            <td style="border:1px dotted #000; padding:6px;">#{{ $transaction->cp }}</td>
            <td style="border:1px dotted #000; padding:6px;">{{ Str::upper($transaction->driver_name) }}</td>
         
        </tr>
    </tbody>
</table>


    <!-- ADDITIONAL INFO -->
    <table style="margin-top: 30px;">
        <tr>
            <th>Número  DO</th>
            <td>{{ $transaction->do_number }}</td>
            <th>Número  SO</th>
            <td>#{{ $transaction->so_number }}</td>
        </tr>
        <tr>
            <th>Codigo de Autorização</th>
            <td>{{ $transaction->approve_number }}</td>
            <th>Autorização Por</th>
            <td>{{ $transaction->authorized_by }} / {{ $transaction->approved }}</td>
        </tr>
        <tr>
            <th>Emitido Por </th>
            <td>{{ $transaction->user_name }}</td>
            <th>Status</th>
            <td>
                <span class="status {{ $transaction->status ? 'completed' : 'pending' }}">
                    {{ $transaction->status ? 'Completed' : 'Pending' }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Data de Emissão</th>
            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- SIGNATURE -->
    <table class="signature-table" style="margin-top:20px; width:100%;" border="1">
        <tr>
            <th>Operador :</th>
            <th>Despacho Por :</th>
        </tr>
        <tr >
            <td>
                <div class="signature-box"></div>
                @if($transaction->product_name === "GASOLINA")
                (SABINO BELO)
                @elseif($transaction->product_name === "GASÓLEO")
                (AMERICO DA SILVA)
                @else
                (AMERICO DA SILVA & SABINO BELO)

                @endif
            </td>
          <td style="text-align:center;">
    <!-- Box tanda tangan / stamp -->

                @if ($transaction->status)
                <div class="signature-box">
                    <img src="{{ public_path('status.png') }}" 
                        alt="Approved" 
                        style="width:100px; height:auto; margin-top:5px;">
                </div>
                    
                @endif
                
                <!-- Nama & authorized_by tetap ada -->
                {{ $transaction->approved }} <br>
                
                ({{ $transaction->authorized_by }})
            </td>

        </tr>
        
    </table>

    <table style="margin-top:20px; width:100%; border-collapse:collapse;">
   <tr>
    <!-- Kolom Clients -->
    <th style="width:50%; text-align:center; font-size:12px; padding:6px;">
        Motorista :
    </th>
    <!-- Kolom Driver -->
    <th style="width:50%; text-align:center; font-size:12px; padding:6px;">
        Recebido Por:
    </th>
</tr>
<tr>
    <!-- Tanda tangan Clients -->
    <td style="height:60px; border-bottom:1px solid #000; text-align:center;">
        ........................................................
        <br>
         ({{ Str::upper($transaction->driver_name)}})
    </td>
    <!-- Tanda tangan Driver -->
    <td style="height:60px; border-bottom:1px solid #000; text-align:center;">
        ........................................................
        <br>
       
    </td>
</tr>
</table>



    <!-- FOOTER -->
    <footer>
     <footer style="text-align:center; font-size:9px; margin-top:10px; color:#777;">
    This document is officially generated by the electronic system of 
    <strong> Esperança Timor Oan,Lda</strong> to ensure authenticity for all clients. <br>
         Thanks .. {{ \Carbon\Carbon::now()->format('Y') }}


    </footer>

</div>
</body>
</html>
