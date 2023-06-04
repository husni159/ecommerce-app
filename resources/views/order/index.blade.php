@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Orders</h1>
        @if ($orders->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Shipping Address</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No orders found.</p>
        @endif
    </div>
@endsection
