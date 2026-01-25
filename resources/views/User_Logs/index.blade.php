@extends('Master.Master')
@section('title','User Logs')

@section('content')
<div class="container-fluid px-4 mt-2">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 text-center">
        <div>
           
        </div>
    </div>

    <!-- Search -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-2">
            <form method="GET" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control form-control-sm"
                           placeholder="Search user, email, IP, browser">
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-primary px-4">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0" style="font-size: 12px;">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th width="4%">#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>IP Address</th>
                            <th>Browser</th>
                            <th>Description</th>
                            <th class="text-center">Method</th>
                            <th width="18%">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $key => $log)
                        <tr>
                            <td class="text-muted">{{ $logs->firstItem() + $key }}</td>
                            <td class="fw-medium">{{ $log->user_name ?? '-' }}</td>
                            <td class="text-muted">{{ $log->user_email ?? '-' }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $log->ip }}</span>
                            </td>
                            <td class="text-muted">{{ $log->browser }}</td>
                            <td>{{ $log->description }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill 
                                    @if($log->method === 'POST') bg-success
                                    @elseif($log->method === 'PUT') bg-warning text-dark
                                    @elseif($log->method === 'DELETE') bg-danger
                                    @elseif($log->method === 'GET') bg-info
                                    @else bg-secondary @endif
                                ">
                                    {{ $log->method }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($log->created_at)->format('D, d M Y') }}<br>
                                <small>{{ \Carbon\Carbon::parse($log->created_at)->format('H:i A') }}</small>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No activity logs available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row m-2">
                    <div class="col">{{ $logs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<style>
    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.6em;
    }
</style>
@endsection
