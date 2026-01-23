@extends('Master.Master')
@section('title','User Logs')

@section('content')
<div class="container-fluid px-4">

    <!-- ===================== -->
    <!-- Search -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">

            <form method="GET" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ $search }}"
                               class="form-control"
                               placeholder="Search name, email, ip, browser...">
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-primary px-3">
                        Search
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ===================== -->
    <!-- Logs Table -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <div class="" style="text-transform: uppercase;">
                    <h6 class="fw-semibold text-uppercase mb-0">User Activity Logs</h6>
                    <small class="text-muted">System activity & audit Users</small>
                </div>
                <div>
                    {{ $logs->links() }}
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th width="4%">#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>IP</th>
                            <th>Browser</th>
                            <th>OS</th>
                            <th class="text-center">Method</th>
                            <th>Description</th>
                            <th width="12%">Created</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse ($logs as $key => $log)
                        <tr class="small">
                            <td class="text-muted">
                                {{ $logs->firstItem() + $key }}
                            </td>
                            <td class="fw-semibold">
                                {{ $log->user_name ?? '-' }}
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $log->user_email ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $log->ip }}
                                </span>
                            </td>
                            <td>{{ $log->browser }}</td>
                            <td>{{ $log->os }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    {{ $log->method == 'POST' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $log->method }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ $log->description }}
                            </td>
                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}<br>
                                <small>{{ \Carbon\Carbon::parse($log->created_at)->format('H:i') }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                                No activity logs found
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
