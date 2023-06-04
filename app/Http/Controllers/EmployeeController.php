<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function createProduct()
    {
        return view('employee.createproduct');
    }

    public function storeProduct(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            // other validation rules
        ]);

        // Create and save the product
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        // set other product attributes
        $product->save();

        return redirect()->route('employee.products.create')->with('success', 'Product added successfully');
    }
}
