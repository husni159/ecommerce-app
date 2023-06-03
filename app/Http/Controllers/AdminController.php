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
        $products = Product::all();
        $orders = Order::all();
        return view('admin.dashboard', compact('products', 'orders'));
    }
    /**
     * Display view products and orders.
     *
     * @return \Illuminate\View\View
     */
    
    public function viewProducts()
    {
        $products = Product::all();
        return view('admin.products.index', ['products' => $products]);
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product approved successfully');
    }

    public function viewOrders()
    {
        $orders = Order::all();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function changeOrderStatus($id)
    {
        $order = Order::findOrFail($id);
        // Logic to change order status
        // ...
        $order->status = 'delivered';
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order status changed successfully');
    }
}
