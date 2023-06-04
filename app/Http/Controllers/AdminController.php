<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    /**
     * Display all products and orders.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $orders = Order::with('user')->orderBy('id', 'desc')->get();
        return view('admin.dashboard', compact('orders'));
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product approved successfully');
    }


    public function changeOrderStatus($id)
    {
        $order = Order::findOrFail($id);
        // Logic to change order status
        // ...
        $order->status = 'delivered';
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Order status changed successfully');
    }

    public function OrderShow($id) {
        $order = Order::with('orderItems')->findOrFail($id);
        
        // Pass the order data to the view
        return view('admin.ordershow', compact('order'));
    }
}
