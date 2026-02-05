@extends('Master.Master')
@section('title','content')
@section('content')

<link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<table class="table table-bordered table-sm align-middle">
    <thead class="table-light text-center">
        <tr>
            <th>Nu</th>
            <th>SO</th>
            <th>LO</th>
            <th>LO Jump</th>
            <th>LO Unregister</th>
            <th>Client</th>
            <th>Quantity</th>
            <th>Product</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $i => $t)
            @php
                $jump = null;
                $missing = [];

                if (!is_null($t->lo_previous)) {
                    $diff = $t->lo_number - $t->lo_previous;
                    if ($diff > 1) {
                        $jump = $diff - 1;
                        for ($x = $t->lo_previous + 1; $x < $t->lo_number; $x++) {
                            $missing[] = $x;
                        }
                    }
                }
            @endphp
            <tr>
                <td class="text-center">{{ $transactions->firstItem() + $i }}</td>
                <td>{{ $t->so_number }}</td>
                <td class="fw-bold text-center">{{ $t->lo_number }}</td>

                <td class="text-center">
                    @if($jump)
                        <span class="text-danger fw-bold">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $jump }}
                        </span>
                    @else
                        <span class="text-success">OK</span>
                    @endif
                </td>

                <td>
                    @if(count($missing))
                        <span class="text-danger fw-bold">
                            <i class="bi bi-x-octagon-fill"></i>
                            {{ implode(', ', $missing) }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                <td>{{ $t->client_name }}</td>
                <td class="text-end">{{ number_format($t->quantity,2) }}</td>
                <td>{{ $t->product_name }}</td>
                <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $transactions->links() }}



    
@endsection