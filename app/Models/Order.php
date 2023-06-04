<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ORDER_STATUS_DELIVERED    = 'delivered';
    const ORDER_STATUS_PENDING      = 'pending';
    const ORDER_STATUS_PROCESSING   = 'processing';

    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }


    // Other custom methods or model code here
}
