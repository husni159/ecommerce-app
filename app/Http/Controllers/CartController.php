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
        // Validate the product quantity
        $product = Product::findOrFail($productId);
        
        // Add the product to the cart in the session
        $cart = session()->get('cart', []);
        if (!empty($cart["$productId"])) {
            $quantity = (int)$quantity + (int)$cart["$productId"]['quantity'];
        }
        $cart[$productId] = [
            'product' => $product,
            'name'     => $product->name,
            'quantity' => $quantity,
            'price'    => $product->price,
            'subtotal' => $quantity*$product->price
        ];
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total     = array_sum(array_column($cartItems, 'subtotal'));
       
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        // Display the checkout form
        return view('cart.checkout',compact('cartItems'));
    }

    public function remove($itemId)
        {
            $cartItems = session()->get('cart', []);
          
            // Find the item in the cart based on the item ID
            
            if (isset($cartItems[$itemId])) {unset($cartItems[$itemId]); };
            

            // Update the cart items in the session
            session()->put('cart', $cartItems);

            return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
        }
    
        public function clear()
        {
            session()->forget('cart');
            return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
        }
        
}

