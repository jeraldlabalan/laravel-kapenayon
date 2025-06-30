<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     // This model represents the cart table in the database
    protected $table = "orders";

    // The primary key for the model
    protected $fillable = [
        'first_name',
        'last_name',
        'state',
        'address',
        'user_id',
        'city',
        'zip_code',
        'phone',
        'email',
        'price',
        'user_id',
        'status',
    ];

    public $timestamps = true;
}
