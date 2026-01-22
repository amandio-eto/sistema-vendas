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

                    <div class="col-md-3">
                        <label class="form-label text-muted small">Client ID</label>
                        <input type="text"
                               name="client_id"
                               class="form-control form-control-sm"
                               value="{{ old('client_id', $client->client_id) }}"
                               readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-muted small">Client Name</label>
                        <input type="text"
                               name="client_name"
                               class="form-control form-control-sm"
                               value="{{ old('client_name', $client->client_name) }}"
                               required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control form-control-sm"
                               value="{{ old('phone', $client->phone) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-muted small">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control form-control-sm"
                               value="{{ old('email', $client->email) }}"
                               required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label text-muted small">Address</label>
                        <input type="text"
                               name="address"
                               class="form-control form-control-sm"
                               value="{{ old('address', $client->address) }}">
                    </div>

                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('client.index') }}"
                       class="btn btn-light btn-sm me-2">
                        Cancel
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4">
                        Update Client
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
