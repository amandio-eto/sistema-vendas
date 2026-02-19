@extends('Master.Master')
@section('title','Total Summary')
@section('content')

<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Total Summary Report</h3>
            <small class="text-muted">Overview of fuel transactions</small>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Start Date</label>
                    <input type="date" name="start_date" value="{{ $start }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">End Date</label>
                    <input type="date" name="end_date" value="{{ $end }}" class="form-control">
                </div>

                <div class="col-md-6 text-end">
                    <button type="submit" class="btn btn-primary px-4 me-2">
                        <i class="bi bi-funnel-fill me-1"></i> Filter
                    </button>

                    <a href="{{ route('totalsummary.pdf', request()->all()) }}" 
                       class="btn btn-danger px-4 me-2">
                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
                    </a>

                    <a href="{{ route('totalsummary.excel', request()->all()) }}" 
                       class="btn btn-success px-4">
                        <i class="bi bi-file-earmark-excel-fill me-1"></i> Excel
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Summary Table Card -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 text-center" style="text-transform: uppercase;">

                    <thead class="table-secondary text-white">
                        <tr>
                            <th class="text-start">Classification</th>
                            <th>Gasoline</th>
                            <th>Gasoleo</th>
                            <th>Jet A1</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $totalGasolina = 0;
                            $totalGasoleo = 0;
                            $totalJet = 0;
                        @endphp

                        @foreach($summary as $type => $row)
                            @php
                                $totalGasolina += $row['GASOLINA'];
                                $totalGasoleo += $row['GASÓLEO'];
                                $totalJet += $row['JET-A1'];
                            @endphp
                            <tr>
                                <td class="fw-semibold text-start">{{ $type }}</td>
                                <td>{{ format_liter($row['GASOLINA']) }}</td>
                                <td>{{ format_liter($row['GASÓLEO']) }}</td>
                                <td>{{ format_liter($row['JET-A1']) }}</td>
                            </tr>
                        @endforeach

                        <!-- Grand Total Row -->
                        <tr class="table-warning fw-bold">
                            <td class="text-start">GRAND TOTAL</td>
                            <td>{{ format_liter($totalGasolina) }}</td>
                            <td>{{ format_liter($totalGasoleo) }}</td>
                            <td>{{ format_liter($totalJet) }}</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection
