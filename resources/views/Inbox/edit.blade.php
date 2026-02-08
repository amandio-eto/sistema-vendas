@extends('Master','Master')
@section('title','Edit Inbox')

@section('content')
<div class="container col-md-8">
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <strong>✏️ Edit Message</strong>
        </div>

        <form method="POST" action="{{ route('inbox.update', $message->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="mb-3">
                    <label>Subject</label>
                    <input type="text" name="subject"
                           value="{{ $message->subject }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Message</label>
                    <textarea name="message" rows="5"
                              class="form-control">{{ $message->message }}</textarea>
                </div>
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-warning btn-sm">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
