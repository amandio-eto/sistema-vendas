@extends('Master.Master')

@section('content')
<div class="card shadow-sm rounded-4">
    <div class="card-body">

        <!-- FILTER -->
        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date"
                       value="{{ $startDate ?? '' }}"
                       class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date"
                       value="{{ $endDate ?? '' }}"
                       class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Client</label>
                <select name="client_name" class="form-control">
                    <option value="">-- All Client --</option>
                    @foreach($clients as $c)
                        <option value="{{ $c->client_name }}"
                            {{ ($clientName ?? '') == $c->client_name ? 'selected' : '' }}>
                            {{ $c->client_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('reports.client-summary.pdf', request()->all()) }}"
                   class="btn btn-danger">PDF</a>
                <a href="{{ route('reports.client-summary.excel', request()->all()) }}"
                   class="btn btn-success">Excel</a>
            </div>
        </form>

        <!-- TABLE -->
        <table class="table table-bordered table-striped text-center">
            <thead class="table-info">
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
                @forelse($summaryData as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-start">{{ $row->client_name }}</td>
                        <td>{{ format_liter($row->ron98, 2) }}</td>
                        <td>{{ format_liter($row->ron92, 2) }}</td>
                        <td>{{ format_liter($row->ppm10, 2) }}</td>
                        <td>{{ format_liter($row->jeta1, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No Data Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
