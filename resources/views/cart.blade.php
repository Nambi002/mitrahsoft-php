@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h4 class="mb-5"> My Cart</h4>

<div class="card shadow-sm mb-4">
    <div class="card-body">
     <div class="row g-2">
        
         
@foreach($carts as $cart)


<div class="d-flex justify-content-space-between">
<div style=" margin:10px; padding:10px;"  class="d-flex jusity-content-end col-md-6  ms-2">
     <div class="">
   <img src="{{ asset('storage/'.$cart->product->image) }}" width="100" class="mb-2">
</div>
 <div class=" ms-5 "> 
   <h5>{{ $cart->product->name }}</h5>
    <p>Qty: {{ $cart->quantity }}</p>

    <p class="mt-3">Price: ₹ {{ $cart->product->price }}</p>
    <form action="{{ route('cart.remove', $cart->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-secondary">Remove</button>
    </form>
      


</div>

</div>
</div>
<hr>
@endforeach
</div>

    <form action="{{ route('cart.buyNow', $cart->id) }}" method="POST" style="display:inline;">
        @csrf
        <div style="display:flex;justify-content:end;">
        <button type="submit" class="btn btn-warning" >Buy Now</button>
        </div>
    </form>
@endsection
</div>
