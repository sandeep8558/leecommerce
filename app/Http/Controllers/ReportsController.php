<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Order;
use App\Models\OrderData;


class ReportsController extends Controller
{
    
    public function purchase(Request $request){
        $today = date('Y-m-d');
        $from = $today;
        $to = $today;
        $what = "All";
        $id = null;
        if(isset($request->from)){ $from = $request->from; }
        if(isset($request->to)){ $to = $request->to; }

        if(isset($request->what)){
            $what = $request->what;
        }

        if(isset($request->id)){
            $id = $request->id;
        }

        $purchase = Purchase::whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

        if($id != null || $what != ""){
            switch($what){
                case "category_id":
                $purchase->whereHas('product', function($q) use($what, $id){
                    $q->whereHas('category', function($qq) use($what, $id) {
                        $qq->where($what, $id);
                    });
                });
                break;
                case "sub_category_id":
                $purchase->whereHas('product', function($q) use($what, $id){
                    $q->whereHas('sub_category', function($qq) use($what, $id) {
                        $qq->where($what, $id);
                    });
                });
                break;
                case "product_group_id":
                $purchase->whereHas('product', function($q) use($what, $id){
                    $q->whereHas('product_group', function($qq) use($what, $id) {
                        $qq->where($what, $id);
                    });
                });
                break;
                case "product_id":
                $purchase->where($what, $id);
                break;
            }
        }

        $total_amount = $purchase->sum('amount');
        $total_qty = $purchase->sum('quantity');
        $purchase_cycles = $purchase->count();
        $purchase = $purchase->simplePaginate(20);
        
        return view("administrator.reports.purchase", compact("from", "to", "what", "id", 'purchase', 'total_amount', 'purchase_cycles', 'total_qty'));
    }

    public function sale(Request $request){

        $today = date('Y-m-d');
        $from = $today;
        $to = $today;
        $what = "All";
        $id = null;
        if(isset($request->from)){ $from = $request->from; }
        if(isset($request->to)){ $to = $request->to; }

        if(isset($request->what)){
            $what = $request->what;
        }

        if(isset($request->id)){
            $id = $request->id;
        }

        $sale = OrderData::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);

        if($id != null || $what != ""){
            switch($what){
                case "category_id":
                $sale->whereHas('product', function($q) use($what, $id){
                    $q->whereHas('category', function($qq) use($what, $id) {
                        $qq->where($what, $id);
                    });
                });
                break;
                case "sub_category_id":
                $sale->whereHas('product', function($q) use($what, $id){
                    $q->whereHas('sub_category', function($qq) use($what, $id) {
                        $qq->where($what, $id);
                    });
                });
                break;
                case "product_group_id":
                $sale->whereHas('product', function($q) use($what, $id){
                    $q->whereHas('product_group', function($qq) use($what, $id) {
                        $qq->where($what, $id);
                    });
                });
                break;
                case "product_id":
                $sale->where($what, $id);
                break;
            }
        }

        $total_amount = $sale->sum('rate_total');
        $total_qty = $sale->sum('qty');
        $sale_cycles = $sale->count();
        $s = $sale;
        $s = $s->get();
        $purchase = $s->sum('purchase_amount');
        $profit = $total_amount - $purchase;

        $sale = $sale->simplePaginate(20);

        return view("administrator.reports.sale", compact("from", "to", "what", "id", "sale", "total_amount", "total_qty", "sale_cycles", "purchase", "profit"));
    }

    public function invoices(Request $request){
        $today = date('Y-m-d');
        $from = $today;
        $to = $today;
        if(isset($request->from)){ $from = $request->from; }
        if(isset($request->to)){ $to = $request->to; }

        $sale = Order::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);

        $mrp_total = $sale->sum('mrp_total');
        $cost_total = $sale->sum('cost_total');
        $tax_total = $sale->sum('tax_total');
        $rate_total = $sale->sum('rate_total');
        $discount = $sale->sum('discount');
        $offer_discount = $sale->sum('offer_discount');
        $delivery = $sale->sum('delivery');
        $payable = $sale->sum('payable');

        $invoices = $sale->count();

        $sale = $sale->simplePaginate(20);

        return view("administrator.reports.invoices", compact("from", "to", "sale", "mrp_total", "cost_total", "tax_total", "rate_total", "discount", "offer_discount", "delivery", "payable", "invoices"));
    }

    public function products(){
        $today = date('Y-m-d');
        $from = $today;
        $to = $today;
        if(isset($request->from)){ $from = $request->from; }
        if(isset($request->to)){ $to = $request->to; }

        $sale = OrderData::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);

        return view("administrator.reports.products", compact("from", "to"));
    }

}
