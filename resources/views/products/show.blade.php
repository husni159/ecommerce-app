@extends('layouts.app')

@section('content')
    <div class="container card-container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-price">Price: ${{ $product->price }}</p>
              
                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
<style>
.card {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
}

.card-text {
    margin-bottom: 15px;
    color: #666;
}

.card-price {
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.card-container {
    max-width: 600px;
    margin: 0 auto;
}
.card-container {
    max-width: 600px;
    margin: 0 auto;
}

.card-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

.card-text {
    font-size: 16px;
    margin-bottom: 20px;
}

.card-price {
    font-size: 18px;
    margin-bottom: 10px;
}

.form-label {
    font-weight: bold;
}

.btn-block {
    display: block;
    width: 100%;
}

 </style>
@endsection
