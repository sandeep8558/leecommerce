<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Charts\SampleChart;


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
        $purchase_cycles = $purchase->count('amount');
        $purchase = $purchase->simplePaginate(20);
        
        return view("administrator.reports.purchase", compact("from", "to", "what", "id", 'purchase', 'total_amount', 'purchase_cycles', 'total_qty'));
    }

}
