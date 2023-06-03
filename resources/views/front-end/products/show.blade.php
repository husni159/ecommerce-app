@extends('layouts.app')

@section('content')
    <h1>Product Details</h1>
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>

    <!-- Add to cart form -->
    <form action="{{ route('cart.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
@endsection
