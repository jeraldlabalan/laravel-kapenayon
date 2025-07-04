<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Review;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch the latest 4 products from the database
        $products = Product::select()->orderBy('id', 'desc')->take('4')->get();

        $reviews = Review::select()->orderBy('id', 'desc')->take('4')->get();

        // Return the view with the products and reviews data
        return view('home', compact('products', 'reviews'));

    }
}
