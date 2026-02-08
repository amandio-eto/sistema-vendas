@extends('Master.Master')


@section('content')
<div class="row m-4">
    <div class="col">
        <div class="container">



<form method="POST" action="{{ route('tank.store') }}">
@csrf


<div class="mb-3">
<label>Tank Name</label>
<input type="text" name="tank_name" class="form-control" required>
</div>


<div class="mb-3">
<label>Capacity Tank</label>
<input type="number" step="0.01" name="capacity_tank" class="form-control" required>
</div>


<div class="mb-3">
<label>Product</label>
<select name="product_id" class="form-control" required>
@foreach($products as $product)
<option value="{{ $product->id }}">{{ $product->product_name }}</option>
@endforeach
</select>
</div>


<button class="btn btn-success">Save</button>
<a href="{{ route('tank.index') }}" class="btn btn-secondary">Back</a>
</form>
</div>
    </div>
</div>
@endsection