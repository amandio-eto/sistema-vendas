@extends('Master.Master')
@section('title','Drivers')

@section('content')
<div class="container-fluid px-4">

    <!-- ===================== -->
    <!-- Create Driver Form -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm mb-4 mt-1">
        <div class="card-body">

            <h6 class="fw-semibold mb-3">Add New Driver</h6>

            <form method="POST" action="{{ route('drivers.store') }}" class="row g-3">
                @csrf

                <!-- Driver Name -->
                <div class="col-md-5">
                    <label class="form-label small text-muted">Driver Name</label>
                    <input type="text"
                           name="driver_name"
                           class="form-control form-control-sm @error('driver_name') is-invalid @enderror"
                           value="{{ old('driver_name') }}"
                           placeholder="Driver name" required>
                    @error('driver_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-md-4">
                    <label class="form-label small text-muted">Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control form-control-sm @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}"
                           placeholder="+670..." required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-sm btn-success px-4">
                        Save <i class="bi bi-send"></i>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- ===================== -->
    <!-- Drivers Table -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0" style="font-size: 12px">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th width="5%">#</th>
                            <th>Driver Name</th>
                            <th>Phone</th>
                            <th width="18%">Created</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($drivers as $key => $driver)
                        <tr class="small">
                            <td class="text-muted">{{ $drivers->firstItem() + $key }}</td>
                            <td class="fw-medium">{{ $driver->driver_name }}</td>
                            <td>{{ $driver->phone }}</td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($driver->created_at)->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('drivers.edit',$driver->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @if(Auth::user()->roles==='staff')
                                @else
                                 <form action="{{ route('drivers.destroy',$driver->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this driver?')">
                                       <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                               
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No drivers found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $drivers->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
