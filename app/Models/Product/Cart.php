<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // This model represents the cart table in the database
    protected $table = "cart";

    // The primary key for the model
    protected $fillable = [
        'product_id',
        'name',
        'price',
        'image',
        'user_id',
    ];

    public $timestamps = true;
}
