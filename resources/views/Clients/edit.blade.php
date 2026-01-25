@extends('Master.Master')
@section('title', 'Edit Client')

@section('content')
<div class="container-fluid px-4">

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <!-- Header -->
            <div class="text-center mb-4 border-bottom pb-2">
                <h5 class="fw-semibold mb-1 text-uppercase">Edit Client</h5>
                <small class="text-muted">Update client information</small>
            </div>

            <!-- Form -->
            <form action="{{ route('client.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Client ID -->
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Client ID</label>
                        <input type="text"
                               name="client_id"
                               class="form-control form-control-sm @error('client_id') is-invalid @enderror"
                               value="{{ old('client_id', $client->client_id) }}"
                               readonly>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Client Name -->
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Client Name</label>
                        <input type="text"
                               name="client_name"
                               class="form-control form-control-sm @error('client_name') is-invalid @enderror"
                               value="{{ old('client_name', $client->client_name) }}"
                               required>
                        @error('client_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control form-control-sm @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $client->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control form-control-sm @error('email') is-invalid @enderror"
                               value="{{ old('email', $client->email) }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="col-md-8">
                        <label class="form-label text-muted small">Address</label>
                        <input type="text"
                               name="address"
                               class="form-control form-control-sm @error('address') is-invalid @enderror"
                               value="{{ old('address', $client->address) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('client.index') }}"
                       class="btn btn-primary btn-sm me-2">
                       <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                    <button type="submit"
                            class="btn btn-warning btn-sm px-4">
                        Update Client <i class="bi bi-pencil-square"></i>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
