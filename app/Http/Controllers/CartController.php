<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::findOrFail($productId);

        // Add the product to the cart in the session
        $cart = session()->get('cart', []);
        $cart[$productId] = [
            'product' => $product,
            'quantity' => $quantity
        ];
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function checkout()
    {
        // Display the checkout form
        return view('cart.checkout');
    }
}
