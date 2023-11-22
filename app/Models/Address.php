<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'landmark',
        'pincode',
        'country',
        'state',
        'city',
        'user_id',
        'atype',
        'addresable_type',
    ];
}
