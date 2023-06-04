@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>

    <h2>Order ID: {{ $order->id }}</h2>
    <p>Customer Name: {{ $order->user->name }}</p>
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
                    <td>{{ $item->product->price * $item->quantity}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($order->status !== 'delivered')
        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="status">Update Status:</label>
            <select name="status" id="status">
                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
            <button type="submit">Update</button>
        </form>
    @endif
@endsection
