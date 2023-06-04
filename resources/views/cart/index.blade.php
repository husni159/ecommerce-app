<h2>Cart</h2>
@if(count($cartItems) > 0)
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($cartItems as $prodId => $item)
            <tr>
                <tr>
                    <td>{{  $item['product']->name }}</td>
                    <td>${{ $item['product']->price }}</td>
                    <td>{{  $item['quantity'] }}</td>
                    <td>${{ $item['subtotal'] }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $prodId) }}" method="GET">
                            @csrf
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Total: ${{ $total }}</td>
                <td>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Clear Cart</button>
                </form>
                </td>
            </tr>
        </tfoot>
    </table>
@else
    <p>Your cart is empty.</p>
@endif
@if(count($cartItems) > 0)
<a href="{{ route('cart.checkout') }}">Proceed to Checkout</a>
@endif
<a href="{{ route('products.index') }}">Proceed to purchase</a>
