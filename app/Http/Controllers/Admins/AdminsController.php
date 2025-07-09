<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Booking;
use App\Models\Product\Order;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use Redirect;
use File;

class AdminsController extends Controller
{


    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('view.login');
    }


    public function viewLogin()
    {
        // Return the admin login view
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {
        $productsCount = Product::select()->count();
        $ordersCount = Order::select()->count();
        $bookingsCount = Booking::select()->count();
        $adminsCount = Admin::select()->count();

        return view('admins.index', compact('productsCount', 'ordersCount', 'bookingsCount', 'adminsCount'));
    }

    public function displayAllAdmins()
    {
        $allAdmins = Admin::select()->orderBy('id', 'asc')->get();

        return view('admins.alladmins', compact('allAdmins'));


    }

    public function createAdmins()
    {


        return view('admins.createadmins');


    }


    public function storeAdmins(Request $request)
    {
        // Validate the request data
        Request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $storeAdmins = Admin::Create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        if($storeAdmins) {
            return Redirect::route('all.admins')->with(['success' => 'Admin created successfully!']);

        }

    }

    public function displayAllOrders()
    {
        $allOrders = Order::select()->orderBy('id', 'asc')->get();

        return view('admins.allorders', compact('allOrders'));



    }

    public function editOrder($id)
    {
        $order = Order::find($id);


        return view('admins.editorder', compact('order'));
    }

    public function updateOrder(Request $request,$id)
    {
        $order = Order::find($id);

        $order->update($request->all());

        if($order) {
            return Redirect::route('all.orders')->with(['update' => 'Order status updated successfully!']);
        }
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);

        $order->delete();

        if($order) {
            return Redirect::route('all.orders')->with(['delete' => 'Order deleted successfully!']);
        }
    }

    public function displayAllProducts()
    {
        $products = Product::select()->orderBy('id', 'asc')->get();

        return view('admins.allproducts', compact('products'));
    }

    public function createProduct()
    {
        return view('admins.createproduct');
    }

    public function storeProduct(Request $request)
    {
        // Validate the request data
        // Request()->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|max:255',
        //     'password' => 'required|string|min:8',
        // ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeProduct = Product::Create([
            "name" => $request->name,
            "price" => $request->price,
            "image" => $myimage,
            "description" => $request->description,
            "type" => $request->type,
        ]);

        if($storeProduct) {
            return Redirect::route('all.products')->with(['success' => 'Product created successfully!']);

        }

    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if(File::exists(public_path('assets/images/' . $product->image))){
            File::delete(public_path('assets/images/' . $product->image));
        }else{
            //dd('File does not exists.');
        }

        $product->delete();

        if($product) {
            return Redirect::route('all.products')->with(['delete' => 'Product deleted successfully!']);
        }

    }


    public function displayBookings()
    {
        $bookings = Booking::select()->orderBy('id', 'asc')->get();

        return view('admins.allbookings', compact('bookings'));
    }




}






