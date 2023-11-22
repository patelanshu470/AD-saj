<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
}
