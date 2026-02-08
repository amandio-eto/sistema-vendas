@extends('Master.Master')
@section('title','Inbox')

@section('content')
<div class="container">
    <div class="card shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between">
            <strong><i class="bi bi-inbox-fill"></i> Inbox</strong>
            <a href="{{ route('inbox.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-send"></i> New Message
            </a>
        </div>

        <div class="card-body p-0" style="font-size: 12px;">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inboxes as $msg)
                        <tr class="{{ !$msg->is_read ? 'fw-bold' : '' }}">
                            <td>{{ $msg->sender_name }}</td>
                            <td>
                                <a href="{{ route('inbox.show', $msg->id) }}">
                                    {{ $msg->subject }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($msg->created_at)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted p-3">
                                Inbox empty
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
