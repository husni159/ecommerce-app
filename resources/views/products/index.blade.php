@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
@endsection
