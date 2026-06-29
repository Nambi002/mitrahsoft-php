<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

@extends('layouts.app')
@section('content')

<div class="container mt-4">

<div class="row">
<h4 class="mb-5 mt-2">Top Deals</h4>
@foreach($products as $product)
<div class="col-md-3 mb-3">
    <div class="card border-0 shadow-sm h-100" style="width:250px;">
            <p class="text-success fw-bold ms-5 d-flex justify-content-end">
                @if($product->stock > 0)
                    <span class="badge bg-success">In Stock</span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </p>

<div class="card-body">

<a href="{{ route('products.show', $product->id) }}">
<img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" style="height:180px; width:214px; object-fit:cover; ">
</a>
           <p style="font-size:18px; font-weight:bold; margin-top:10px; display:flex; justify-content:center;">{{ $product->name }}</p>
          
<div class="d-flex justify-content-content-between align-items-center">
    
    <p class="text-success fw-bold ms-4"> ₹{{ number_format($product->price) }}</p>               
        
<form action="/add-to-cart/{{ $product->id }}" method="GET">
    <button type="submit"  class="btn btn-warning btn-sm ms-5" {{ $product->stock <= 0 ? 'disabled' : '' }}>
        Add to Cart
    </button>
</form>




@if(session('success'))
    <div id="popup" style=" position: fixed; top: 90%; left: 50%; transform: translate(-50%, -50%); background: #222; color: #ffbe0b; padding: 20px 40px;border-radius: 8px; z-index: 1000;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('popup').remove();
        }, 2000);
    </script>
@endif           

</div>
</div>        
</div>
</div>

@endforeach
</div>
@endsection


