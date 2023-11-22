<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function getOrderProduct()
    {
        return $this->belongsTo(OrderProduct::class,'order_product_id');
    }

    public function getproductsData()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }
}
