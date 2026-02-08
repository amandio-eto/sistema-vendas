@extends('Master.Master')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="bi bi-droplet-half text-info"></i> Tank Management
        </h4>

        <a href="{{ route('tank.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Tank
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th class="text-start">Tank Name</th>
                            <th>Product</th>
                            <th>Capacity</th>
                            <th>Current Stock</th>
                            <th>Switch</th>
                            <th>Status</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tanks as $tank)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>

                            <td class="text-start fw-semibold">
                                <a href="{{ route('tank.stock.create',['id'=>$tank->id]) }}">
                                    {{  $tank->tank_name}}

                                </a>
                               
                            </td>

                            <td>{{ $tank->product_name }}</td>

                            <td>
                                {{ number_format($tank->capacity_tank,2) }}
                            </td>

                            <td>
                                {{ number_format($tank->current_stock,2) }}
                            </td>

                            <!-- Toggle -->
                            <td>
                                <form action="{{ route('tank.toggle', $tank->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="btn btn-sm {{ $tank->active ? 'btn-success' : 'btn-outline-secondary' }}">
                                        <i class="bi {{ $tank->active ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                    </button>
                                </form>
                            </td>

                            <!-- Status Badge -->
                            <td>
                                <span class="badge rounded-pill
                                    {{ $tank->active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                    {{ $tank->active ? 'ACTIVE' : 'INACTIVE' }}
                                </span>
                            </td>

                            <!-- Action -->
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('tank.edit',$tank->id) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('tank.destroy',$tank->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Delete this tank?')"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
