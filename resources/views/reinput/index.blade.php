@extends('Master.Master')
@section('title','Transactions')

@section('content')
<div class="container-fluid px-4 mt-2">

    <!-- ===================== -->
    <!-- Breadcrumb -->
    <!-- ===================== -->
   

    <!-- ===================== -->
    <!-- CREATE TRANSACTION FORM -->
    <!-- ===================== -->
    @if(Auth::user()->roles==='manager')
    @else



<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 mt-3">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <!-- Header -->
        <div class="text-center mb-4">
            <h5 class="fw-bold text-uppercase mb-0">REINPUT DATA</h5>
            <small class="text-muted">REINPUT TRANSACTION</small>
            <hr class="w-25 mx-auto mt-3">
        </div>

        <form action="{{ route('reinput.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4 align-items-end">

                <!-- DO NUMBER -->
              

                <!-- LO -->
                <div class="col-md-3">
                    <label class="form-label small text-muted">LO Number</label>
                    <input type="number" name="lo_number" value="{{ old('lo_number') }}"
                           class="form-control form-control-sm">
                    @error('lo_number') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- SO -->
                <div class="col-md-3">
                    <label class="form-label small text-muted">SO Number</label>
                    <input type="text" name="so_number" value="{{ old('so_number') }}"
                           class="form-control form-control-sm">
                    @error('so_number') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Payment References -->
                <div class="col-md-3">
                    <label class="form-label small text-muted">Payment References</label>
                    <input type="text" name="payment_references"
                           class="form-control form-control-sm">
                    @error('payment_references') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Product (Single Select2) -->
                <div class="col-md-3">
                    <label class="form-label small text-muted fw-semibold">Product</label>
                    <select name="id_product" class="form-select select2-single">
                        <option value="">--Select Product--</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ old('id_product') == $product->id ? 'selected' : '' }}>
                                {{ $product->product_name }} — {{ $product->quality }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_product') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Client (Single Select2) -->
                <div class="col-md-3">
                    <label class="form-label small text-muted fw-semibold">Client</label>
                    <select name="id_client" id="client_select" class="form-select select2-single">
                        <option value=""></option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ old('id_client') == $client->id ? 'selected' : '' }}>
                                {{ $client->client_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_client') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Driver (Single Select2) -->
                {{-- <div class="col-md-3">
                    <label class="form-label small text-muted fw-semibold">Driver</label>
                    <select name="id_driver" id="driver_select" class="form-select select2-single">
                        <option value=""></option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}"
                                {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->driver_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_driver') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}


                    <div class="col-md-3">
                        <label class="form-label small text-muted fw-semibold">Driver</label>
                        <select name="id_driver" id="driver_select" class="form-select select2-single">
                            <option value=""></option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->driver_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_driver') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                <!-- Quantity -->
                <div class="col-md-2">
                    <label class="form-label small text-muted">Quantity (Liter)</label>
                    <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}"
                           class="form-control form-control-sm">
                    @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Plate Number -->
                <div class="col-md-2">
                    <label class="form-label small text-muted">Plate Number</label>
                    <input type="text" name="plat_number" value="{{ old('plat_number') }}"
                           class="form-control form-control-sm">
                    @error('plat_number') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="col-md-2">
                    <label class="form-label small text-muted">Date</label>
                    <input type="date" name="created_at" value="{{ old('created_at') }}"
                           class="form-control form-control-sm">
                </div> 

                <!-- Description -->
                <div class="col-md-6">
                    <label class="form-label small text-muted">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}"
                           class="form-control form-control-sm">
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Attachment -->
                <div class="col-md-2">
                    <label class="form-label small text-muted">Attachment</label>
                    <input type="file" name="attached" class="form-control form-control-sm">
                </div>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-end mt-5 gap-2">
                <button type="reset" class="btn btn-outline-danger btn-sm">Reset</button>
                <button type="submit" class="btn btn-success btn-sm px-4">
                    Save <i class="bi bi-check-circle ms-1"></i>
                </button>
            </div>
        </form>
    </div>
</div>


    @endif

    <!-- ===================== -->
    <!-- TRANSACTION TABLE -->
    <!-- ===================== -->
    <div class="card border-0 shadow-sm rounded mt-2">
        <div class="card-body">

            <!-- Table Header -->
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h6 class="fw-semibold text-uppercase mb-0">Transaction List</h6>

                
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle table-striped"
                       style="font-size:10px">
                <thead class="bg-light text-uppercase small fw-semibold sticky-top">
                        <tr>
                            <th>#</th>
                            <th>Act. Trans</th>
                            <th>DO</th>
                            <th>SO</th>
                            <th>LO</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Driver</th>
                            <th>Qty (L)</th>
                            <th>Request</th>
                            <th>Status</th>
                            <th>Plat</th>
                            <th>Payment References</th>
                            <th>Description</th>
                            <th>Attachment</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $key => $tx)
                        <tr class="{{ !$tx->status ? 'table-warning' : '' }}">
                               

                            <td>{{ $transactions->firstItem() + $key }}</td>
                             <td class="text-center">
                                    @if(\Carbon\Carbon::parse($tx->created_at)->isToday())
                                        <i class="fa-solid fa-circle-check text-success" title="Today"></i>
                                    @endif
                                </td>
                            <td class="fw-bold">
                                  <a style="color: black;" href="{{ route('transaction.print',$tx->id) }}">
                                {{ $tx->do_number }}
                                </a>
                            </td>
                            <td>
                                 <a href="{{ route('transaction.print',$tx->id) }}">
                                {{ $tx->so_number }}
                                 </a>
                            </td>
                            <td>{{ $tx->lo_number }}</td>
                            <td>{{ $tx->product_name."/".$tx->quality }}</td>
                            <td>{{ $tx->client_name }}</td>
                            <td>{{ $tx->driver_name }}</td>
                            <td>{{ number_format($tx->quantity,2,',','.') }}</td>
                            <td>

                                @if ($tx->statusedit==true && Auth::user()->roles==='staff')
                                <i class="bi bi-unlock text-danger"></i>
                                @else
                                
                                @if (Auth::user()->roles==='administrator' || Auth::user()->roles==='manager')
                                @else
                                <form action="{{ route('statusedit',['id'=>$tx->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <button class="btn btn-success btn-sm">
                                    <i class="bi bi-lock"></i>
                                </button>
                                </form>
                                    
                                @endif
                                    
                                @endif
                                
                            </td>
                            <td>
                                <span class="badge {{ $tx->status ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $tx->status ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $tx->plat_number }}</td>
                            <td>
                                {{ $tx->payment_references }}
                            </td>
                            <td>
                                {{ $tx->description }}
                            </td>

                            <!-- ATTACHMENT -->
                            <td class="text-center">
                                @if($tx->attached)
                                    <a href="{{ asset('storage/'.$tx->attached) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary"
                                       title="View Attachment">
                                        <i class="bi bi-paperclip"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($tx->created_at)->translatedFormat('d M Y H:i') }}
                            </td>

                           

                            <!-- ACTION -->
                            <td class="text-end">
                                @if(Auth::user()->roles==='staff')
                                
                                
                                @else
                                <a href="{{ route('transaction.edit',$tx->id) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('transaction.destroy',$tx->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this transaction?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                
                                @endif

                                @if($tx->button===1 && Auth::user()->roles==='staff')
                                  <a href="{{ route('transaction.edit',$tx->id) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @endif

                                
                                    <a href="{{ route('transaction.print',$tx->id) }}"
                                       class="btn btn-sm btn-secondary ms-1">
                                        <i class="bi bi-printer"></i>
                                    </a>
                          
                            
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                                No transactions found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $transactions->links() }}
            </div>

        </div>
    </div>

    </div>
    @endsection

@section('footer')









<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

$(document).ready(function(){
    // All single Select2
    $('#product_select, #client_select, #driver_select').select2({
        placeholder: 'Select an option...',
        allowClear: true,
        theme: 'bootstrap4',
        width: '100%'
    });

    // Click anywhere to focus
    $(document).on('click', '.select2-selection', function(){
        $(this).closest('.select2-container').prev('select').select2('open');
    });

    // Auto-focus search field
    $(document).on('select2:open', function(){
        document.querySelector('.select2-search__field')?.focus();
    });
});
</script>


<script>
$(document).ready(function(){
    // Driver single-select
    $('#driver_select').select2({
        placeholder: 'Select a driver...',
        allowClear: true,
        theme: 'bootstrap4',
        width: '100%'
    });

    // Auto-focus search field on open
    $(document).on('select2:open', function(){
        document.querySelector('.select2-search__field')?.focus();
    });
});
</script>






    
@endsection

