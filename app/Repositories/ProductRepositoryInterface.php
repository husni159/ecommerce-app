<?php
// app/Repositories/ProductRepositoryInterface.php

namespace App\Repositories;
use App\Models\Product;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function getAllProducts();

    public function getProductById($id);

    public function getAllApprovedProducts(array $data);
    public function saveProduct(Request $request);
    public function approveProduct(Request $request);

}
