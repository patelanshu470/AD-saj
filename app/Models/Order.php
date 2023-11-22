<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=['user_id','order_id',
    'subtotal',
    'total_discount',
    'grand_total',
    'payment_method',
    'billing_contact_name',
    'billing_contact_email',
    'billing_contact_number',
    'shipping_contact_name',
    'shipping_contact_email',
    'shipping_contact_number',
    'order_note',
    'payment_status',
    'country_type',
    'unique_id'
];
public function getOrderInformation()
{
    return $this->hasMany(OrderProduct::class,'order_id');
}

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class,'order_id');
    }

}
