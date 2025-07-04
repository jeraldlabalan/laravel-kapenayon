<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //

    protected $table = 'reviews';


    protected $fillable = [
        'name',
        'review',
    ];

    public $timestamps = true;
}
