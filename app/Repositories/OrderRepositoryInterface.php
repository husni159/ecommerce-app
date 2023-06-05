<?php
// app/Repositories/ProductRepositoryInterface.php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function saveorder($validatedData, $userId);

    public function getCustomerOrders();

    public function fetcheOrderDetails($id);

}
