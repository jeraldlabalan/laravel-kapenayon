<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Cart;
use Auth; // Import the Auth facade for user authentication
use Redirect; // Import the Redirect facade for redirection

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


            // Check if the product is already in the user's cart
            $checkingInCart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->count();

        // Return the view with the product data
        return view('products.productsingle', compact('product', 'relatedProducts', 'checkingInCart'));
    }

    // This method handles adding a product to the cart
    public function addCart(Request $request, $id)
    {
        $addCart = Cart::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
        ]);

        return Redirect::route('product.single', $id)->with(['success' => 'Product added to cart successfully!']);
    }

}
