@extends('layouts.app')

@section('content')
    <h1>Your Orders</h1>
    @if(count($orders) > 0)
        <ul>
            @foreach($orders as $order)
                <li>
                    <a href="{{ route('orders.show', ['id' => $order->id]) }}">Order #{{ $order->id }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no orders.</p>
    @endif
@endsection
