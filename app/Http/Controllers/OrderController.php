<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function orderPlace(Request $request)
    {
        // Check if the user is logged in and has the customer role
        if (Auth::check() && Auth::user()->getType() === 'customer' && !empty(session()->get('cart'))) {
            // Place the order logic here
            // Validate the form input
                $userId = Auth::user()->userId();
                $validatedData = $request->validate([
                    'name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                ]);

                // Get the cart items from the session
                $cartItems = session()->get('cart');
                // Save the order details to the database
                $order                   = new Order();
                $order->user_id          = $userId;
                $order->shipping_address = $validatedData['address'];
                $order->total_amount     = array_sum(array_column($cartItems, 'subtotal'));
                $order->status           = Order::ORDER_STATUS_PENDING;
                $order->created_at       = date('Y-m-d H:i:s');
                $order->updated_at       = date('Y-m-d H:i:s');
                // Set any other relevant order details
                $order->save();
                // Save the order items to the database
                foreach ($cartItems as $proId => $item) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id    = $order->id;
                    $orderItem->product_id  = $proId;
                    $orderItem->quantity    = $item['quantity'];
                    // Set any other relevant order item details
                    $orderItem->save();
                }
               
                // Clear the cart
                session()->forget('cart');

            // Redirect to a thank you page or order confirmation page
            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        }

        return redirect()->route('login')->with('error', 'You must be logged in as a customer to place an order.');
    }

    public function index()
    {
        // Retrieve orders 
        $user = Auth::user();
        $orders = $user->orders;
        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
       // Fetch the order with the given ID and its associated order items
        $order = Order::with('orderItems')->findOrFail($id);
        if ( auth()->user()->id !== $order->user_id) {
            abort(403); // Unauthorized
        }   
        // Pass the order data to the view
        return view('order.show', compact('order'));
    }
    
}
