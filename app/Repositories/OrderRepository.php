<?php
// app/Repositories/ProductRepository.php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function saveorder($validatedData, $userId)
    {
        // Save the order details to the database
        
        $cartItems = session()->get('cart');
        $order                   = new Order();
        $order->user_id          = $userId;
        $order->shipping_address = $validatedData['address'];
        $order->total_amount     = array_sum(array_column($cartItems, 'subtotal'));
        $order->status           = Order::ORDER_STATUS_PENDING;
        $order->created_at       = date('Y-m-d H:i:s');
        $order->updated_at       = date('Y-m-d H:i:s');
        // Set any other relevant order details
        $order->save();

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
    }

    public function getCustomerOrders()
    {
        $user = Auth::user();
        return $user->orders;
    }

    public function fetcheOrderDetails($id)
    {
        return Order::with('orderItems')->findOrFail($id);
    }
   
}
