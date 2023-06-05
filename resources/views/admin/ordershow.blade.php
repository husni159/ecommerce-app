@extends('layouts.app')

@section('content')
<div class="container">
    <div class="order-details">
        <h1>Order Details</h1>

        <h2>Order ID: {{ $order->id }}</h2>
        <p>Customer Name: {{ $order->user->name }}</p>
        <p>Status: {{ ucfirst($order->status) }}</p>

        <h3>Order Items</h3>
        <table class="order-items">
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
                    <td>${{ $item->product->price }}</td>
                    <td>${{ $item->product->price * $item->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($order->status !== 'delivered')
        <form class="update-status-form" action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="status">Update Status:</label>
            <select name="status" id="status">
                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
            <button type="submit" class="update-status-button">Update</button>
        </form>
        @endif
    </div>
</div>
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .order-details {
        margin: 20px;
    }

    .order-details h1 {
        font-size: 24px;
    }

    .order-details h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .order-details p {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .order-items {
        width: 100%;
        border-collapse: collapse;
    }

    .order-items th,
    .order-items td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    .order-items th {
        background-color: #f0f0f0;
    }

    .order-items td {
        text-align: center;
    }

    .update-status-form {
        margin-top: 20px;
    }

    .update-status-form label {
        margin-right: 10px;
    }

    .update-status-button {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .update-status-button:hover {
        background-color: #0056b3;
    }
</style>
@endsection