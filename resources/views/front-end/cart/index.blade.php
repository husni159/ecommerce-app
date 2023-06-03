@extends('layouts.app')

@section('content')
    <h1>Cart Items</h1>
    @if(count($cart) > 0)
        <ul>
            @foreach($cart as $productId => $cartItem)
                <li>
                    {{ $cartItem['product']->name }} - Quantity: {{ $cartItem['quantity'] }}
                </li>
            @endforeach
        </ul>
        <a href="{{ route('cart.checkout') }}">Proceed to Checkout</a>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection
