<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user is logged in and has the customer role
        if (Auth::check() && Auth::user()->getType() === 'customer') {
            // Place the order logic here
            // ...

            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        }

        return redirect()->route('login')->with('error', 'You must be logged in as a customer to place an order.');
    }

    public function index()
    {
        // Retrieve orders for the authenticated customer
        $user = Auth::user();
        $orders = $user->orders;

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Retrieve the order for the authenticated customer
        $user = Auth::user();
        $order = $user->orders()->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
