@extends('Master.Master')
@section('title','Chat')
@section('content')

<div class="container col-md-8">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $message->subject }}</strong>
            </div>
            <div>
                <small>{{ $message->created_at->format('d M Y H:i') }}</small>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <span class="text-muted">From:</span>
                <strong>{{ $message->sender->name }} ({{ $message->sender->email }})</strong>
            </div>

            <div class="mb-3">
                <span class="text-muted">To:</span>
                <strong>{{ $message->receiver->name }} ({{ $message->receiver->email }})</strong>
            </div>

            <hr>

            <div style="white-space: pre-line; font-size: 14px;">
                {{ $message->message }}
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <div>
                <a href="{{ route('inbox.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="d-flex gap-2">
                {{-- Reply button --}}
                <a href="{{ route('inbox.chat', $message->sender->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-reply-fill"></i> Reply
                </a>

                {{-- Delete button --}}
                <form method="POST" action="{{ route('inbox.destroy', $message->id) }}"
                      onsubmit="return confirm('Delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
