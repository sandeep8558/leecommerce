<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Setting;
use Auth;
use App\Models\Address;
use App\Http\Requests\AddressRequest;
use Razorpay\Api\Api;
use App\Models\Page;

use App\Models\Order;
use App\Models\Offer;

class CheckoutController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(){
        $user = Auth::user();
        $delivery_timing = Setting::where('key', 'Delivery Timing')->exists() ? Setting::where('key', 'Delivery Timing')->first()->val : null;
        $buyqty = Setting::where('key', 'Buy Quantity')->exists() ? Setting::where('key', 'Buy Quantity')->first()->val : null;
        $delivery_charges = Setting::where('key', 'Delivery Charges')->exists() ? Setting::where('key', 'Delivery Charges')->first()->val : null;
        $free_delivery_amount = Setting::where('key', 'Free Delivery Amount')->exists() ? Setting::where('key', 'Free Delivery Amount')->first()->val : null;
        $minimum_order_amount = Setting::where('key', 'Minimum Order Amount')->exists() ? Setting::where('key', 'Minimum Order Amount')->first()->val : null;

        $cod = Setting::where('key', 'COD')->exists() ? Setting::where('key', 'COD')->first()->val : null;
        $online = Setting::where('key', 'Online payment')->exists() ? Setting::where('key', 'Online payment')->first()->val : null;
        $color = Setting::where('key', 'Theme Color')->exists() ? Setting::where('key', 'Theme Color')->first()->val : null;

        $meta = Page::where('page', 'Checkout')->latest()->first();
        return view("website.checkout", compact("delivery_timing", "buyqty", "delivery_charges", "free_delivery_amount", "minimum_order_amount", "user", "cod", "online", "color", "meta"));
    }

    public function save_address(AddressRequest $request){
        $address = Auth::user()->addresses()->create($request->all());
        Auth::user()->addresses()->update([
            "default" => "No"
        ]);
        Address::find($address->id)->update([
            "default" => "Yes"
        ]);
        return ["addresses" => Auth::user()->addresses];
    }

    public function set_default_address(Request $request){
        Auth::user()->addresses()->update([
            "default" => "No"
        ]);
        Address::find($request->id)->update([
            "default" => "Yes"
        ]);
        return Auth::user()->addresses;
    }

    public function delete_address(Request $request){
        Address::find($request->id)->update([
            "deleted" => "Yes"
        ]);

        return Auth::user()->addresses;
    }

    public function pay(Request $request){

        $user = Auth::user();
        $order = $user->orders()->create($request->order);
        $order_id = null;
        foreach($request->order_data as $od){
            $order_data = $order->order_data()->create($od);
        }
        if($request->order["orderstatus"] == "Pending"){
            $key = Setting::where('key', 'Razorpay API Key')->exists() ? Setting::where('key', 'Razorpay API Key')->first()->val : null;
            $secret = Setting::where('key', 'Razorpay API Secret')->exists() ? Setting::where('key', 'Razorpay API Secret')->first()->val : null;
            $api = new Api($key, $secret);
            $razorOrder = $api->order->create([
                'receipt' => $order->id,
                'amount' => $order->payable * 100,
                'currency' => 'INR'
            ]);
            $order_id = $razorOrder['id'];
        }

        if($order->orderstatus == "Success"){
            session(["cart" => []]);
        }

        return [
            "order_id"=>$order_id,
            "order"=>$order
        ];
    }

    public function update_order(Request $request){
        session(["cart" => []]);
        $input = $request->all();
        $input["payment_at"] = date('Y-m-d H:i:s');
        return Order::find($request->id)->update($input);
    }

    public function check_coupon(Request $request){
        $today = date('Y-m-d');
        $response = [
            "message" => "",
            "data" => null
        ];
        $offer = Offer::where('coupon_code', $request->coupon);

        /* Checked Coupon Exist OR Not */
        if($offer->exists()){

            if($offer->whereDate('start', '<=', $today)->whereDate('end', '>=', $today)->exists()){
                
                $offer = $offer->first();
                
                $isValidUser = false;

                if($offer->offer_for == 'All Orders'){
                    $isValidUser = true;
                }
                
                if($offer->offer_for == 'First Order'){
                    if(Auth::user()->orders()->where('orderstatus', 'Success')->where('cancelled_at', null)->doesntExist()){
                        $isValidUser = true;
                    } else {
                        $isValidUser = false;
                    }
                }

                if($isValidUser){

                    if($request->rate_total >= $offer->minimum_purchase_amount){

                        if($offer->ticket_size == 0 || $offer->actual_ticket_size < $offer->ticket_size){

                            if($offer->ticket_per_day == 0 || $offer->actual_ticket_per_day < $offer->ticket_per_day){

                                if($offer->ticket_per_customer == 0 || $offer->actual_ticket_per_customer < $offer->ticket_per_customer){

                                    if($offer->ticket_per_customer_per_day == 0 || $offer->actual_ticket_per_customer_per_day < $offer->ticket_per_customer_per_day){

                                        $response["data"] = $offer;
                                        $response["message"] = "Offer Applied";

                                    } else {
                                        $response["message"] = "You already have used this offer today.";
                                    }

                                } else {
                                    $response["message"] = "You already have used this offer.";
                                }

                            } else {
                                $response["message"] = "Offer Closed For The Day.";
                            }

                        } else {
                            $response["message"] = "Offer Closed.";
                        }

                    } else {
                        /* Minimum order amount */
                        $response["message"] = "Offer only valid for purchase of Rs.".$offer->minimum_purchase_amount."/- and above.";
                    }

                } else {
                    /* Not Valid User */
                    $response["message"] = "This offer is not valid for you.";
                }

            } else {
                /* Not Valid for Today */
                $response["message"] = "Coupon not valid for today.";
            }

        } else {
            /* If Coupon Doesn't Exist */
            $response["message"] = "Invalid Coupon.";
        }

        return $response;
    }
}
