@extends('Master.Master')

@section('title', 'Change Password')

@section('content')
<div class="container py-5" style="max-width: 480px;">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header text-center py-4" >
            <h4 class="mb-0 fw-bold text-center" style="text-align: center;">Change Password</h4>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="mb-3">
                    <label for="current_password" class="form-label fw-medium">Current Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock-fill text-primary"></i></span>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium">New Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-key-fill text-success"></i></span>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Confirm New Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-medium">Confirm New Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-shield-lock-fill text-danger"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg fw-semibold">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


