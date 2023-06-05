@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="card" style="max-width: 400px; margin: 0 auto;">
        <div class="card-header">
            <h1 class="card-title">
                <center>Create Product</center>
            </h1>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" step="0.01" class="form-control" required>
                </div>

                <center><button type="submit" class="btn btn-primary">Create</button></center>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .card-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .status {
        font-weight: bold;
    }

    .table {
        width: 100%;
    }

    .table th {
        text-align: center;
    }

    .table td {
        text-align: left;
    }
</style>
@endsection