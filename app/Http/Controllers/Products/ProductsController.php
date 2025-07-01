<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use Auth; // Import the Auth facade for user authentication
use Redirect; // Import the Redirect facade for redirection
use Session; // Import the Session facade for session management


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

    // This method retrieves the user's cart
    public function cart()
    {
        $cartProducts = Cart::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $totalPrice = Cart::where('user_id', Auth::user()->id)
            ->sum('price');

        return view('products.cart', compact('cartProducts', 'totalPrice'));
    }

    // This method deletes a product from the cart
    public function deleteProductCart($id)
    {
        $deleteProductCart = Cart::where('product_id', $id)
         ->where('user_id', Auth::user()->id);

        $deleteProductCart->delete();

        if($deleteProductCart)
        {
            return Redirect::route('cart')->with(['delete' => 'Product removed from cart successfully!']);
        }

    }

    // This method prepares the checkout process
    public function prepareCheckout(Request $request)
    {
        $value = $request->price;

        $price = Session::put('price', $value);

        $newPrice = Session::get($price);

        if($newPrice > 0)
        {
            return Redirect::route('checkout');
        }
    }

    public function checkout()
    {


        return view('products.checkout');

    }



     public function storeCheckout(Request $request)
    {
        $checkOut = Order::create($request->all());


        if($checkOut)
        {
            return Redirect::route('products.pay');
        }
    }

    public function payWithPaypal()
    {
        return view('products.pay');
    }

    public function success()
    {
        $deleteItems = Cart::where('user_id', Auth::user()->id);
        $deleteItems->delete();


        if($deleteItems)
        {
            return view('products.success');
        }

    }

}
