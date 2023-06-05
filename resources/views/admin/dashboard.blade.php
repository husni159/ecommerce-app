@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center font-weight-bold">Orders</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->id }}</a></td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
@endsection
