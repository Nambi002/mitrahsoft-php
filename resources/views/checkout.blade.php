@extends('layouts.app')
@section('content')

<h3 class="mt-3 p-3">Checkout</h3>

<form method="POST" action="/place-order">
@csrf

<div style="display:flex; gap:30px;">

    <div style= "width:70%; border:1px solid #ccc; padding:20px; border-radius:8px; margin-left:20px;">
         <h5 class="mb-5">Select Address</h5>
                 <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px;">

   
        @if(count($addresses) > 0)

            @foreach($addresses as $address)
                <div style="border:1px solid #ddd; padding:10px; margin-bottom:10px; border-radius:6px; cursor:pointer; display:block;">
                    <label style="cursor:pointer; display:block;">       
                    <input type="radio" name="address_id" value="{{ $address->id }}"
                    {{ session('last_address_id') == $address->id ? 'checked' : '' }}>
                    
                    <strong>{{ $address->name }}</strong><br>
                    {{ $address->address1 }}<br>
                    {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}<br>
                    {{ $address->mobile }}
                </div>
            @endforeach
</div>
<hr style="margin:20px 0;">

<div style="display:flex; gap:30px; align-items:center;">

            <label>
                <input type="radio" name="new_address" value="no" checked onclick="toggleAddress(false)">
                Use existing
            </label>

            <label style="margin-left:20px;">
                <input type="radio" name="new_address" value="yes" onclick="toggleAddress(true)">
                Add New Address
            </label>

</div>

        @else
          
            <input type="hidden" name="new_address" value="yes">
        @endif

     
        <div id="newAddressForm" style="margin-top:20px; display: {{ count($addresses) > 0 ? 'none' : 'block' }};">

            <h5 class="mb-4 mt-4">Add New Address</h5>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">

                <input type="text" name="name" placeholder="Full Name" style="padding:4px; padding-left:10px;">
                <input type="email" name="email" placeholder="Email" style="padding:4px; padding-left:10px;">

                <input type="text" name="mobile" placeholder="Mobile" maxlength="10" style="padding:4px; padding-left:10px;">
                <input type="text" name="pincode" placeholder="Pincode" style="padding:4px; padding-left:10px;">

                <input type="text" name="city" placeholder="City" style="padding:4px; padding-left:10px;">
                <input type="text" name="state" placeholder="State" style="padding:4px; padding-left:10px;">

                <input type="text" name="country" placeholder="Country" style="padding:4px; padding-left:10px;">

                <input type="text" name="address1" placeholder="Address Line 1" style="grid-column: span 2; padding:4px; padding-left:10px;">
                <input type="text" name="address2" placeholder="Address Line 2" style="grid-column: span 2; padding:4px; padding-left:10px;">

            </div>
                <button type="submit" style="
            width:20%;
            margin-left:80%;
            padding:12px;
            background:#2c3e50;
            color:white;
            border:none;
            border-radius:5px;
            margin-top:15px;
        ">Add</button>
        </div>

    </div>

    
    <div style="width:30%; border:1px solid #ccc; padding:20px; border-radius:8px; margin-right:20px;">

        <h3>Order Summary</h3>

        @php $total = 0; @endphp

        @foreach($carts as $cart)
            @php 
                $subtotal = $cart->product->price * $cart->quantity;
                $total += $subtotal;
            @endphp

            <div style="border-bottom:1px solid #eee; padding:10px 0;">
                <img src="{{ asset('storage/'.$cart->product->image) }}" width="100" class="mb-2"><br>
                <strong>{{ $cart->product->name }}</strong><br>
                Qty:{{ $cart->quantity }}<br>
                Price: ₹ {{ $cart->product->price }}<br>
                Subtotal: ₹ {{ $subtotal }}
            </div>
        @endforeach

        <h4 style="margin-top:20px;">Total: ₹ {{ $total }}</h4>

        <button type="submit" style="
            width:100%;
            padding:12px;
            background:#2c3e50;
            color:white;
            border:none;
            border-radius:5px;
            margin-top:15px;
        ">Place Order</button>

    </div>

</div>

</form>

<script>
function toggleAddress(show) {
document.getElementById('newAddressForm').style.display = show ? 'block' : 'none';
}

</script>

@endsection
