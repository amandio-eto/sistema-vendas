@extends('Master.Master')
@section('title','Edit Transaction')

@section('content')
<div class="container-fluid px-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item">
                <a href="{{ route('transaction.index') }}">Transaction</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Edit Transaction
            </li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <!-- Header -->
            <div class="text-center mb-4 border-bottom pb-2">
                <h5 class="fw-semibold mb-1 text-uppercase">
                    Edit Transaction
                </h5>
                <small class="text-muted">
                    Update transaction details carefully
                </small>
            </div>

            <!-- Form -->
            <form action="{{ route('transaction.update', $transaction->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- LO -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">LO Number</label>
                        <input type="number" name="lo_number"
                               value="{{ old('lo_number', $transaction->lo_number) }}"
                               class="form-control form-control-sm">
                        @error('lo_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- SO -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">SO Number</label>
                        <input type="text" name="so_number"
                               value="{{ old('so_number', $transaction->so_number) }}"
                               class="form-control form-control-sm">
                        @error('so_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Product -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Product</label>
                        <select name="id_product" class="form-select form-select-sm">
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('id_product', $transaction->id_product) == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name }} {{ $product->quality ? '#'.$product->quality : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_product')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Client -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Client</label>
                        <select name="id_client" class="form-select form-select-sm">
                            <option value="">-- Select Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('id_client', $transaction->id_client) == $client->id ? 'selected' : '' }}>
                                    {{ $client->client_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_client')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Driver -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Driver</label>
                        <select name="id_driver" class="form-select form-select-sm">
                            <option value="">-- Select Driver --</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ old('id_driver', $transaction->id_driver) == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->driver_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_driver')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Quantity (L)</label>
                        <input type="number" step="0.01" name="quantity"
                               value="{{ old('quantity', $transaction->quantity) }}"
                               class="form-control form-control-sm">
                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Plat -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Plat Number</label>
                        <input type="text" name="plat_number"
                               value="{{ old('plat_number', $transaction->plat_number) }}"
                               class="form-control form-control-sm">
                        @error('plat_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-md-2">
                        <label class="form-label small text-muted">Date</label>
                        <input type="date" name="created_at"
                               value="{{ old('created_at', optional($transaction->created_at)->format('Y-m-d')) }}"
                               class="form-control form-control-sm">
                    </div>

                    <!-- Attachment -->
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Attachment</label>
                        <input type="file" name="attached"
                               class="form-control form-control-sm">
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4 gap-2">
                    <a href="{{ route('transaction.index') }}"
                       class="btn btn-primary btn-sm px-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>

                    <button type="submit"
                            class="btn btn-warning btn-sm px-4 text-dark">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
