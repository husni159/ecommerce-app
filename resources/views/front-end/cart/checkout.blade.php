@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <!-- Order details form fields -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address">

        <button type="submit">Place Order</button>
    </form>
@endsection
