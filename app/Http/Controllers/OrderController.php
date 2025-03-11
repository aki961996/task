<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class OrderController extends Controller
{
    public function index(Request $request): View{
        $order = Order::orderBy('id','DESC')->paginate(5);
        return view('orders.index',compact('order'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function delivered(Request $request, $id)
    {
        if (Auth::id()) {
            $order_id = decrypt($request->id);
            $order_table_data_asper_id = Order::find($order_id);
            $order_table_data_asper_id->delivary_status = 'Delivered';
            $order_table_data_asper_id->payment_status = 'Paid';
            $order_table_data_asper_id->save();
            return redirect()->back()->with('message', 'Delivered');
        } else {
            return redirect('login');
        }
    }

   
}
