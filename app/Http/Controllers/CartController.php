<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Offer;

class CartController extends Controller
{

    public function index(){
        /* session(["cart" => []]); */
        $delivery_timing = Setting::where('key', 'Delivery Timing')->exists() ? Setting::where('key', 'Delivery Timing')->first()->val : null;
        $buyqty = Setting::where('key', 'Buy Quantity')->exists() ? Setting::where('key', 'Buy Quantity')->first()->val : null;
        $delivery_charges = Setting::where('key', 'Delivery Charges')->exists() ? Setting::where('key', 'Delivery Charges')->first()->val : null;
        $free_delivery_amount = Setting::where('key', 'Free Delivery Amount')->exists() ? Setting::where('key', 'Free Delivery Amount')->first()->val : null;
        $minimum_order_amount = Setting::where('key', 'Minimum Order Amount')->exists() ? Setting::where('key', 'Minimum Order Amount')->first()->val : null;
        $meta = Page::where('page', 'Cart')->latest()->first();
        return view("website.cart", compact("delivery_timing", "buyqty", "delivery_charges", "free_delivery_amount", "minimum_order_amount", "meta"));
    }

    public function add(Request $request){
        $request;
        $buyQty = Setting::where('key', 'Buy Quantity')->exists() ? Setting::where('key', 'Buy Quantity')->first()->val : null;
        $product = Product::find($request->product_id)->data_qty;
        $qty = $product > $buyQty ? $buyQty : $product;

        $cart = session("cart");
        $is = false;
        foreach($cart as $i=>$c){
            if($c["product_id"] == $request->product_id){
                if($qty >= $c["quantity"]){
                    $cart[$i]['quantity'] = isset($request->qty) ? $request->qty : ($qty > $c["quantity"] ? $c["quantity"] + 1 : $c["quantity"]);
                }
                $is = true;
            }
        }
        if(!$is){
            $cart[] = [
                "user_id" => $request->user_id,
                "product_id" => $request->product_id,
                "quantity" => 1,
            ];
        }
        
        session(["cart" => $cart]);

        return session("cart");
    }

    public function get_cart(Request $request){
        $pids = [];
        $cart = session("cart");
        foreach($cart as $c){
            $pids[] = $c["product_id"];
        }
        $products = Product::whereIn("id", $pids)->get();
        $response = [
            "products" => $products,
            "calc" => [
                "mrp_total" => 0,
                "rate_total" => 0,
                "tax_total" => 0,
                "cost_total" => 0,
                "delivery_charges" => 0,
                "discount" => 0,
                "offer_discount" => 0,
                "payable" => 0,
                "canProceed" => false
            ]
        ];
        foreach($products as $product){
            $response["calc"]["mrp_total"] += $product["data_calc"]["mrp_total"];
            $response["calc"]["rate_total"] += $product["data_calc"]["rate_total"];
            $response["calc"]["tax_total"] += $product["data_calc"]["tax_total"];
            $response["calc"]["cost_total"] += $product["data_calc"]["cost_total"];
        }
        $response["calc"]["discount"] = $response["calc"]["mrp_total"] - $response["calc"]["rate_total"];

        if(isset($request->offer_id)){
            $offer = Offer::find($request->offer_id);
            if($offer->offer_type == 'Flat Discount'){
                $response["calc"]["offer_discount"] = $offer->offer_value;
            }
            if($offer->offer_type == 'Percentile Discount'){
                $response["calc"]["offer_discount"] = $response["calc"]["rate_total"] * $offer->offer_value / 100;
                if($response["calc"]["offer_discount"] > $offer->maximum_offer_amount){
                    $response["calc"]["offer_discount"] = $offer->maximum_offer_amount;
                }
            }
        }

        $minimum_order_amount = Setting::where('key', 'Minimum Order Amount')->exists() ? Setting::where('key', 'Minimum Order Amount')->first()->val : null;
        $response["calc"]["canProceed"] = $response["calc"]["rate_total"] >= $minimum_order_amount ? true : false;
        $delivery_charges = Setting::where('key', 'Delivery Charges')->exists() ? Setting::where('key', 'Delivery Charges')->first()->val : null;
        $free_delivery_amount = Setting::where('key', 'Free Delivery Amount')->exists() ? Setting::where('key', 'Free Delivery Amount')->first()->val : null;
        $response["calc"]["delivery_charges"] = $response["calc"]["rate_total"] >= $free_delivery_amount ? 0 : $delivery_charges ;
        $response["calc"]["payable"] =  $response["calc"]["rate_total"] + $response["calc"]["delivery_charges"] - $response["calc"]["offer_discount"];

        return $response;
    }

    public function deleteCart(){
        session()->forget('cart');
        return session("cart");
    }

    public function delete_cart_item($id){
        $cart = session("cart");
        $r = null;
        foreach($cart as $i=>$c){
            if($c["product_id"] == $id){
                $r = $i;
            }
        }
        unset($cart[$r]);
        session(["cart" => $cart]);
        return $this->get_cart();
    }

    
}
