<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;

class ProductsController extends Controller
{
    // This method retrieves a single product by its ID
    public function singleProduct($id)
    {
        // Fetch the product by ID from the database
        $product = Product::find($id);

        // Show related products based on type
        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $id) // Exclude the current product
            ->take(4) // Limit to 4 related products
            ->orderBy('id', 'desc')
            ->get();

        // Return the view with the product data
        return view('products.productsingle', compact('product', 'relatedProducts'));
    }
}
