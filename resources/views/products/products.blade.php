@extends('layouts.app')

@section('content')
<h1>
    <center>Products</center>
</h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (count($products)>0)
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->status }}</td>
            @if ($user->getType() === \App\Models\User::TYPE_ADMIN && $product->status != 1)
            <td>
                <form action="{{ route('admin.products.approve', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Approve</button>
                </form>
            </td>
            @endif

        </tr>
        @endforeach
        @else
        <p>No items found.</p>
        @endif
    </tbody>
</table>
@endsection