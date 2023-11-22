<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function getProductInformation()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function quantity()
    {
        return $this->hasMany(ProductColor::class,'product_id');
    }

    public function getProductGallary()
    {
        return $this->hasMany(Gallary::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductReview::class)->where('status', 1);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
