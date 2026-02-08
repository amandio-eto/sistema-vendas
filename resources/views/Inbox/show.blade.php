@extends('Master.Master')

@section('title','Chat')
@section('content')
<div class="container col-md-8">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>{{ $message->subject }}</strong>
            <div class="small">
                {{ \Carbon\Carbon::parse($message->created_at)->format('d M Y H:i') }}
            </div>
        </div>

        <div class="card-body">
            <p><strong>From:</strong> {{ $message->sender_name }} ({{ $message->sender_email }})</p>
            <p><strong>To:</strong> {{ $message->receiver_name }} ({{ $message->receiver_email }})</p>

            <hr>

            <div style="white-space: pre-line">
                {{ $message->message }}
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('inbox.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <form method="POST" action="{{ route('inbox.destroy', $message->id) }}"
                  onsubmit="return confirm('Delete this message?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
