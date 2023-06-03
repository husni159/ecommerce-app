<?php
@extends('layouts.app')

@section('content')
    <h1>Orders</h1>

    <table>
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
                    <td><a href="{{ route('orders.show', $order) }}">{{ $order->id }}</a></td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

