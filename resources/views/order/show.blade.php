@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Order Details</h1>
            <h2>Order ID: {{ $order->id }}</h2>
            <p class="status">Status: {{ ucfirst($order->status) }}</p>

            <h3>Order Items</h3>
            @if ($order->orderItems->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity * $item->product->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No items found in this order.</p>
            @endif
        </div>
    </div>
</div>
@endsection