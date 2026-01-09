<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function index()
    {
        if (Auth::check() && Auth::user()->user_type === 'user') {
            return view('dashboard');
        } else if (Auth::user()->user_type === 'admin') {
            return view('admin.dashboard');
        }
    }

    public function home()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } else {
            $count = 0;
        }

        $products = Product::latest()->take(4)->get();
        return view('index', compact('products', 'count'));
    }

    public function productDetails($id)
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } else {
            $count = 0;
        }
        $product = Product::findOrFail($id);
        return view('product_details', compact('product'));
    }

    public function allProducts()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } else {
            $count = 0;
        }
        $products = Product::paginate(8);
        return view('allproducts', compact('products'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;


        $product_cart->save();
        return redirect()->back()->with('cart_message', 'added to the cart');
    }


    public function cartProducts()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
            $cart = ProductCart::where('user_id', Auth::id())->get();
        } else {
            $count = 0;
        }

        return view('viewcartproducts', compact('count', 'cart'));
    }

    public function removeCartProducts($id)
    {
        $cart_product = ProductCart::findOrFail($id);

        $cart_product->delete();
        return redirect()->back();
    }

    public function confirmOrder(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'receiver_address' => 'required|string',
                'receiver_phone' => 'required|string',
            ]);


            $order = Order::create([
                'receiver_address' => $request->receiver_address,
                'receiver_phone' => $request->receiver_phone,
                'user_id' => Auth::id(),
            ]);

            $cartItems = ProductCart::where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                ]);
            }

            ProductCart::where('user_id', Auth::id())->delete();

        });
        return redirect()->back()->with('comfirm_order_message', 'Order Successfully');


    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('viewmyorders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

}
