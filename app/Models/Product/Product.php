<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    // Specify the table name
    protected $table = 'products';

    // Columns in the products table
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
    ];

    public $timestamps = true;



}
