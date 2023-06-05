@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">My Orders</h1>
    @if ($orders->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped" style="max-width: 800px; margin: 0 auto;">
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
                @if (count($orders)>0)
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->shipping_address }}</td>
                    <td>${{ $order->total_amount }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View Details</a>
                    </td>
                </tr>
                @endforeach
                @else
                <p>No items found.</p>
                @endif
            </tbody>
        </table>
    </div>
    @else
    <p class="text-center">No orders found.</p>
    @endif
</div>
@endsection