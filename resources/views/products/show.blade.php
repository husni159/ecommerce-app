@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <p>Price: ${{ $product->price }}</p>
      
        <form action="{{ route('cart.store', $product->id) }}" method="POST">
            @csrf
            <div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>
            <button type="submit">Add to Cart</button>
        </form>
    </div>
@endsection
