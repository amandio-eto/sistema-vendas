@extends('Master.Master')

@section('title','Client Summary')

@section('content')
<div class="container-fluid py-3">

    {{-- ================= CARD WRAPPER ================= --}}
    <div class="card shadow-sm rounded-4">

        {{-- ================= CARD BODY ================= --}}
        <div class="card-body">

            {{-- ================= FILTER FORM ================= --}}
            <form method="GET" class="row g-3 mb-4 align-items-end">

                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-dark">Start Date</label>
                    <input type="date" name="start_date"
                           value="{{ $startDate ?? '' }}"
                           class="form-control form-control-sm shadow-sm text-dark">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-dark">End Date</label>
                    <input type="date" name="end_date"
                           value="{{ $endDate ?? '' }}"
                           class="form-control form-control-sm shadow-sm text-dark">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-dark">Client</label>
                    <select name="client_name" class="form-select form-select-sm shadow-sm text-dark">
                        <option value="">-- All Client --</option>
                        @foreach($clients as $c)
                            <option value="{{ $c->client_name }}"
                                {{ ($clientName ?? '') == $c->client_name ? 'selected' : '' }}>
                                {{ $c->client_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm shadow-sm w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>

                    <a href="{{ route('reports.client-summary.pdf', request()->all()) }}"
                       target="_blank"
                       class="btn btn-outline-danger btn-sm shadow-sm w-50">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>

                    <a href="{{ route('reports.client-summary.excel', request()->all()) }}"
                       class="btn btn-outline-success btn-sm shadow-sm w-50">
                        <i class="bi bi-file-earmark-excel"></i> Excel
                    </a>
                </div>

            </form>

            {{-- ================= SUMMARY TABLE ================= --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center mb-0 text-dark"
                       style="font-size: 12px;color:black;">

                    <thead class="table-light text-dark">
                        <tr>
                            <th>No</th>
                            <th class="text-start">Client Name</th>
                            <th>RON98</th>
                            <th>RON92</th>
                            <th>10PPM</th>
                            <th>JET-A1</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($summaryData as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-start fw-semibold">{{ $row->client_name }}</td>
                            <td class="text-end">{{ format_liter($row->ron98, 2) }}</td>
                            <td class="text-end">{{ format_liter($row->ron92, 2) }}</td>
                            <td class="text-end">{{ format_liter($row->ppm10, 2) }}</td>
                            <td class="text-end">{{ format_liter($row->jeta1, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No Data Available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div> {{-- end card-body --}}
    </div> {{-- end card --}}
</div> {{-- end container --}}
@endsection
