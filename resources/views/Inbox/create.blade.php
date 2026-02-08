@extends('Master.Master')
@section('title','Inbox')

@section('content')

<div class="container col-md-6 mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong><i class="bi bi-send-fill"></i> New Message</strong>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('inbox.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">To</label>
                    <select name="receiver_id" class="form-select" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ Str::upper($user->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="5" class="form-control" required></textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('inbox.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-send"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
