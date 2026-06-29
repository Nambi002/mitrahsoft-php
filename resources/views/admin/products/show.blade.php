@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="mt-2 mb-2">
        <h5>Product Details</h5>
        <hr>
    </div>
        <div class="col-md-5">
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" style="height:180px; width:214px; object-fit:cover; ">
        </div>
        <div class="col-md-7">
            <h3>{{ $product->name }}</h3>

            <p class="text-muted">{{ $product->short_description }}</p>

            <p class="text-muted">{{ $product->long_description }}</p>

            <h4 class="text-success fw-bold">
                ₹{{ number_format($product->price) }}
            </h4>

            @if($product->stock > 0)
                <p class="text-success">In Stock</p>
            @else
                <p class="text-danger">Out of Stock</p>
            @endif

            <div class="d-flex align-items-center mb-3">
                <label class="me-2">Qty:</label>
                <input type="number" value="1" min="1" 
                       max="{{ $product->stock }}" 
                       class="form-control w-25">
            </div>

            <div class="d-flex gap-2">
                 <a class=" btn btn-warning btn-sm ms-5 d-flex justify-content-end" href="/add-to-cart/{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }} >
                Add to Cart
           </a>

              
            </div>

        </div>

    </div>

  @if(session('success'))
    <div id="popup" style="
        position: fixed;
        top: 90%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #222;
        color: #ffbe0b;
        padding: 20px 40px;
        border-radius: 8px;
        z-index: 1000;
    ">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('popup').remove();
        }, 2000);
    </script>
@endif  

</div>
@endsection
