@extends('Master.Master')
@section('title','Clients')

@section('content')

<div class="row m-3">
    <div class="col-12">

        <!-- ===================== -->
        <!-- Client Form -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm mb-4" style="border: 2px solid black;">
            <div class="card-body">

                <div class="mb-4 text-center" style="border-bottom: 1px solid black;">
                    <h5 class="card-title mb-1">{{ Str::upper('Create Client') }}</h5>
                    <small class="text-muted fs-12">
                        Add new client information
                    </small>
                </div>
                <hr style="color: black;">

                <form action="{{ route('client.create') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label fs-12 text-muted">Client ID</label>
                            <input type="text" name="client_id"
                                   class="form-control form-control-sm"
                                   placeholder="CL-001" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Client Name</label>
                            <input type="text" name="client_name"
                                   class="form-control form-control-sm"
                                   placeholder="Company / Client Name" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fs-12 text-muted">Phone</label>
                            <input type="text" name="phone"
                                   class="form-control form-control-sm"
                                   placeholder="+670...">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Email</label>
                            <input type="email" name="email"
                                   class="form-control form-control-sm"
                                   placeholder="client@email.com" required>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fs-12 text-muted">Address</label>
                            <input type="text" name="address"
                                   class="form-control form-control-sm"
                                   placeholder="Client Address" required>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-danger btn-sm me-2">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success btn-sm px-4">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===================== -->
        <!-- Client Table -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="mb-3" style="border-bottom: 1px solid black;">
                    <h6 class="fw-semibold mb-0 text-center">{{ Str::upper('Client List') }}</h6>
                </div>
               
                <div class="row mb-2">
                    <div class="col ">
                           {{ $clients->links() }}
                    </div>
                </div>

               
                <div class="table-responsive">
                   
                    <table class="table table-hover align-middle table-sm">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Client ID</th>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $currentPage = $clients->currentPage();
                                $perPage = $clients->perPage();
                                $startNumber = ($currentPage - 1) * $perPage + 1;
                            @endphp

                        @foreach ($clients as $key=>$cl)
                            <tr style="font-size: 12px;">
                              <td>{{ $startNumber + $key }}</td>
                                <td>{{ strtoupper($cl->client_id) }}</td>
                                <td>{{ strtoupper($cl->client_name) }}</td>
                                <td>{{ $cl->email }}</td>
                                <td>{{ $cl->phone }}</td>
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($cl->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="text-end mt-1">
                                <button class="btn btn-sm btn-warning">
                                  <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                 <i class="bi bi-trash"></i>
                                </button>
                            </td>

                            </tr>
                        @endforeach

                        </tbody>
                       
                    </table>
                    
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
