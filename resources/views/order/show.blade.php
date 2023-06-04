@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>
    <h2>Order ID: {{ $order->id }}</h2>
    <p>Status: {{ ucfirst($order->status) }}</p>
    <h3>Order Items</h3>
    <table>
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

@endsection
    