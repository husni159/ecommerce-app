@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>
    <h2>Order #{{ $order->id }}</h2>
    <!-- Display order details and items -->
@endsection
