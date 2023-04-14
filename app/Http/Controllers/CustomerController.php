<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Setting;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index(){
        $user = Auth::user();
        $orders = $user->orders()
        ->where('user_id', $user->id)
        ->where(function($q){
            $q->where('orderstatus', 'Success')->orWhere('orderstatus', 'Cancelled');
        })
        
        ->orderBy('id', 'desc')->simplePaginate(1);
        $cancellation = Setting::where('key', 'Order Cancellation')->exists() ? Setting::where('key', 'Order Cancellation')->first()->val : null;
        $replacement = Setting::where('key', 'Order Replacement')->exists() ? Setting::where('key', 'Order Replacement')->first()->val : null;
        $delivery_timing = Setting::where('key', 'Delivery Timing')->exists() ? Setting::where('key', 'Delivery Timing')->first()->val : null;
        return view("customer.index", compact("user", "orders", "cancellation", "replacement", "delivery_timing"));
    }

    public function cancel($id){
        $timestamp = date('Y-m-d H:i:s');
        $order = Order::find($id);
        $response = 0;
        if($order->shipped_at != null){
            $response = 2;
        } else {
            $order->update([
                "cancelled_at" => $timestamp,
                "orderstatus" => "Cancelled"
            ]);
            $u = $order->order_data()->update([
                "cancelled_at" => $timestamp,
            ]);
            if($u){
                $response = 1;
            }
        }
        
        
        return $response;
    }
}
