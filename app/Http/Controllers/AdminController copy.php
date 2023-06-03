<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display all products and orders.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $products = Product::all();
        $orders = Order::all();
        return view('admin.dashboard', compact('products', 'orders'));
    }

    /**
     * Display details of a specific order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function showOrder(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    /**
     * Update the status of an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:delivered',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.order.show', $order)->with('success', 'Order status updated successfully.');
    }
}
