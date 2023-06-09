<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'status',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Relationships, custom methods, or other model code here
}
