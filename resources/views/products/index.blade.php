@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                @if ($user->getType() !== \App\Models\User::TYPE_CUSTOMER)
                <th>Status</th>
                @endif
                @if ($user->getType() === \App\Models\User::TYPE_CUSTOMER)
                <th>View details</th>
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
                    <td>{{ $product->status != 1?'Pending' : 'Approved' }}</td>
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
                        <a href="{{ route('products.show', $product->id) }}">View Product</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
