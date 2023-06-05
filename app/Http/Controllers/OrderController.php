<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    
    public function orderPlace(Request $request)
    {
        // Check if the user is logged in and has the customer role
        if (Auth::check() && Auth::user()->getType() === 'customer' && !empty(session()->get('cart'))) {
            // Validate the form input
                $userId = Auth::user()->userId();
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error', 'Invalid Details!!');
                }
                // Get the cart items from the session
                $this->orderRepository->saveorder($validator->validated(), $userId);
                
            // Redirect to a thank you page or order confirmation page
            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        }
        return redirect()->route('login')->with('error', 'You must be logged in as a customer to place an order.');
    }

    public function index()
    {
        // Retrieve orders 
        $orders = $this->orderRepository->getCustomerOrders();
        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
       // Fetch the order with the given ID and its associated order items
        $order = $this->orderRepository->fetcheOrderDetails($id);
        if (auth()->user()->id !== $order->user_id) {
            return redirect()->back()->with('email', 'Un authorized user.');
        }   
        // Pass the order data to the view
        return view('order.show', compact('order'));
    }    
}
