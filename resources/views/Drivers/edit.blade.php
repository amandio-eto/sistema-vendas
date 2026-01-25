@extends('Master.Master')
@section('title','Edit Driver')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-3">
        <h5 class="fw-semibold mb-0">Edit Driver</h5>
        <small class="text-muted">Update driver information</small>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form method="POST"
                  action="{{ route('drivers.update',$driver->id) }}"
                  class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label small text-muted">Driver Name</label>
                    <input type="text" name="driver_name"
                           value="{{ $driver->driver_name }}"
                           class="form-control form-control-sm" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label small text-muted">Phone</label>
                    <input type="text" name="phone"
                           value="{{ $driver->phone }}"
                           class="form-control form-control-sm" required>
                </div>

                <div class="col-12 mt-3">
                    <a href="{{ route('drivers.index') }}"
                       class="btn btn-sm btn-secondary">
                        Back
                    </a>
                    <button class="btn btn-sm btn-primary px-4">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
