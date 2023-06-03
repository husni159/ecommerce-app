<?php
@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>

    <h2>Order ID: {{ $order->id }}</h2>
    <p>Customer Name: {{ $order->customer->name }}</p>
    <p>Status: {{ $order->status }}</p>

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
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('admin.order.updateStatus', $order) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="status">Update Status:</label>
        <select name="status" id="status">
            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
        <button type="submit">Update</button>
    </form>
@endsection
    