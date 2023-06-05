<?php
// app/Repositories/ProductRepository.php

namespace App\Repositories;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function getAllApprovedProducts()
    {
        return Product::where('status', 1)->get();
    }
    
    public function saveProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->status = 0; // Set the initial status to 0 (pending)
        $product->save();
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        // Perform the approval logic here
        $product->status = 1;
        $product->save();
    }
    // Add more methods as needed for CRUD operations or custom queries
}
