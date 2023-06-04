@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Products</h1>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="table-header">Name</th>
                        <th class="table-header">Description</th>
                        <th class="table-header">Price</th>
                        @if ($user->getType() !== \App\Models\User::TYPE_CUSTOMER)
                            <th class="table-header">Status</th>
                        @endif
                        @if ($user->getType() === \App\Models\User::TYPE_CUSTOMER)
                            <th class="table-header">View Details</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            @if ($user->getType() !== \App\Models\User::TYPE_CUSTOMER)
                                <td>{{ $product->status != 1 ? 'Pending' : 'Approved' }}</td>
                            @endif
                            @if ($user->getType() === \App\Models\User::TYPE_ADMIN && $product->status != 1)
                                <td>
                                    <form action="{{ route('products.approve', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </form>
                                </td>
                            @endif
                            @if ($user->getType() === \App\Models\User::TYPE_CUSTOMER && $product->status == 1)
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Product</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .page-title {
            text-align: center;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .table-container {
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-header {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .custom-table td {
            padding: 8px;
            text-align: left;
            font-family: Arial, sans-serif;
            color: #555;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .custom-table tbody tr:hover {
            background-color: #eaeaea;
        }
    </style>
@endsection
