@extends('admin.dashboard')
@section('content')

<div class="card">
    <div class="card-header  text-white" style="background:#2c3e50;">
        Order Details
    </div>

    <div class="card-body">

        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Total:</strong> ₹{{ $order->total_amount }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>

        <hr>

        <h5>Products</h5>

        <table class="table table-bordered">
            <tr>
                <th class="col-1">Image</th>
                <th class="col-2">Name</th>
                <th class="col-1">Qty</th>
                <th class="col-2">Price</th>
            </tr>

            @foreach($order->items as $item)
            <tr>
                <td><img src="{{ asset('storage/'.$item->product->image) }}" width="100" class="mb-2"></td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ $item->price }}</td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

@endsection
