<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Stripe;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::latest()->paginate(5);

        return view('frontEnd.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // methed for frondend
    public function order_detail($id): View
    {
        $id = decrypt($id);

        $product = Product::find($id);


        return view('frontEnd.products.order_detail', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {
            $user = Auth::user();

            $userId = $user->id;

            $id = decrypt($id);


            $product = Product::find($id);

            // $userId = $product->user_id;




            $product_exiting_id_cart_table = Cart::where('product_id', '=', $product->id)->where('user_id', '=', $userId)->get('id')->first();





            if ($product_exiting_id_cart_table) {
                $cart = Cart::find($product_exiting_id_cart_table)->first();

                $quantity = $cart->quantity;

                $cart->quantity = $quantity + $request->quantity;

                $cart->save();
                Alert::success('Product Added Successfully', 'We have addedd product to the cart');
                return redirect()->back();
            } else {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->name = $user->name;
                $cart->product_name = $product->name;


                $cart->detail = $product->detail;

                // Use the null coalescing operator to simplify the price assignment
                $cart->prize = $product->prize;
                // $cart->quantity = $product->quantity;

                $cart->product_id = $product->id;

                // You might want to use the request data instead of hardcoded quantity
                $cart->quantity = $request->quantity;
                $cart->save();
                Alert::success('Product Added Successfully', 'We have addedd product to the cart');
                return redirect()->back();
                // return redirect()->back()->with('message', 'Product Added Successfully');

            }
        } else {
            return redirect('login');
        }
    }

    //show_cart
    public function show_cart()
    {

        if (Auth::id()) {
            $id = Auth::user()->id;

            $cart = Cart::getData($id);
            if ($cart !== null) {
                return view('frontEnd.products.showCart', ['cartItems' => $cart]);
            } else {
                return redirect()->back()->with('error', 'Cart not found for the current user.');
            }
        } else {
            return redirect('login');
        }
    }

    //remove cart
    public function remove_cart($id)
    {
        $decryptedId = decrypt($id);
        $cart_remove = Cart::find($decryptedId);
        $cart_remove->delete();
        //return redirect()->back()->with('message', 'Cart Removed Successfully');
        Alert::info('Cart Removed Successfully');
        
        return redirect()->back();
    }

    //cash_order  cashondelivary
    public function cash_order()
    {
        $user = Auth::user();

        $userId = $user->id;

        $data = Cart::getCartData($userId);

        // $data = Cart::where('user_id', $userId)->get();
        foreach ($data as $dataa) {

            $order = new Order();

            $order->name = $dataa->name;
            $order->email = $dataa->email;

            $order->user_id = $dataa->user_id;
            $order->product_id = $dataa->product_id;
            $order->product_name = $dataa->product_name;
            $order->quantity = $dataa->quantity;
            $order->prize = $dataa->prize;

            $order->payment_status = 'cash on delivary';
            $order->delivary_status = 'processing';

            $order->save();

           

            $cart_id = $dataa->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
           
        }

        // return redirect()->back()->with('message', 'We Received your Order, We will connect with you soon');
        return redirect()->route('show_cart')->with('message', 'We Received your Order, We will connect with you soon');

    }
    public function charge_stripe()
    {
        return view('frontEnd.products.stripe');
    }


    public function  checkout()
    {
        // dd($totalPrize);
        $user = Auth::user();
        $userId = $user->id;
        $cart = Cart::getCartData($userId);
        $line_items = [];
        foreach ($cart as $dataa) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => $dataa['product_name'],
                    ],
                    'unit_amount' => $dataa['prize'] * 100,
                ],
                'quantity' => $dataa['quantity'],
            ];
        }


        \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));
        $session = \Stripe\Checkout\Session::create([

            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('charge_stripe'),

        ]);


        return redirect()->away($session->url);
    }




  
    public function success()
    {
        'hey its work';
    }
}
