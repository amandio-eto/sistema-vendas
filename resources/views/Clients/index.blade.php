@extends('Master.Master')
@section('title', 'Clients')

@section('content')
<div class="container-fluid px-4">

    <!-- ===================== -->
    <!-- Create Client Form -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <!-- Header -->
            <div class="text-center mb-4 border-bottom pb-2">
                <h5 class="fw-semibold mb-1 text-uppercase">Create Client</h5>
                <small class="text-muted">Add new client information</small>
            </div>

            <form action="{{ route('client.create') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <!-- Client ID -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Client ID</label>
                        <input type="text" name="client_id"
                               class="form-control form-control-sm @error('client_id') is-invalid @enderror"
                               value="{{ old('client_id') }}"
                               placeholder="CL-001" required>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Client Name -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Client Name</label>
                        <input type="text" name="client_name"
                               class="form-control form-control-sm @error('client_name') is-invalid @enderror"
                               value="{{ old('client_name') }}"
                               placeholder="Company / Client Name" required>
                        @error('client_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Phone</label>
                        <input type="text" name="phone"
                               class="form-control form-control-sm @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               placeholder="+670...">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Email</label>
                        <input type="email" name="email"
                               class="form-control form-control-sm @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="client@email.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="col-md-8">
                        <label class="form-label small text-muted">Address</label>
                        <input type="text" name="address"
                               class="form-control form-control-sm @error('address') is-invalid @enderror"
                               value="{{ old('address') }}"
                               placeholder="Client address">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-danger btn-sm me-2">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success btn-sm px-4">
                        Save <i class="bi bi-send"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- ===================== -->
    <!-- Client List Table -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h6 class="fw-semibold mb-0 text-uppercase">Client List</h6>
                <div>
                    {{ $clients->links() }}
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle">
                    <thead class="table-light text-uppercase small text-muted">
                        <tr>
                            <th width="5%">#</th>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $key => $cl)
                        <tr class="small">
                            <td>{{ $clients->firstItem() + $key }}</td>
                            <td class="fw-semibold">{{ strtoupper($cl->client_id) }}</td>
                            <td>{{ strtoupper($cl->client_name) }}</td>
                            <td>{{ $cl->email }}</td>
                            <td>{{ $cl->phone }}</td>
                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($cl->created_at)->format('d M Y') }}
                            </td>
                            <td class="text-end">

                                <a href="{{ route('client.edit',['id'=>$cl->id]) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @if(Auth::user()->roles==='staff')

                                @else
                                <form action="{{ route('client.destroy', $cl->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this client?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
