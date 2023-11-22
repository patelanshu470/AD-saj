<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'total_price',
        'color_id'
    ];

    public function getproductsData()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id')->withTrashed();
    }

    public function orders()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
