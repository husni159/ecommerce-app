<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productRepository->getAllProducts();
        $user = auth()->user();
        if ($user->isCustomer()) {
            $products = $this->productRepository->getAllApprovedProducts();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid Details!!');
        }
        $this->productRepository->saveProduct($request);
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
        $this->productRepository->approveProduct($id);        
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
        $product =  $this->productRepository->getProductById($id);
        if (empty($product)) {
            return redirect()->back()->with('error', 'Invalid product!');
        }
        return view('products.show', compact('product'));
    } 
}
