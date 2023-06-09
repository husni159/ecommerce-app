<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    protected $fillable = [
        'order_id', 'product_id', 'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    // Relationships, custom methods, or other model code here
}
