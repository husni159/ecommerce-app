<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        $user = auth()->user();
        if ($user->isCustomer()) {
            $products = Product::where('status', 1)->get();
        }
        return view('products.index', compact('products', 'user'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->status = 0; // Set the initial status to 0 (pending)
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Approve a product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $product = Product::findOrFail($id);
        // Perform the approval logic here
        $product->status = 1;
        $product->save();
        
        return redirect()->back()->with('success', 'Product approved successfully.');

    }
    /**
     * show a product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    } 
}
