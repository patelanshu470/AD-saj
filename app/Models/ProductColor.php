<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getProductInformation()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
