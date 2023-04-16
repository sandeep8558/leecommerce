<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductGroup;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS2D;
use DNS1D;

class AdministratorController extends Controller
{
    public function index(){
        return view("administrator.index");
    }

    public function website_manager_slider(){
        return view("administrator.website_manager.slider");
    }

    public function website_manager_features(){
        return view("administrator.website_manager.features");
    }

    public function website_manager_pages(){
        return view("administrator.website_manager.pages");
    }

    public function website_manager_content(){
        return view("administrator.website_manager.content");
    }

    

    public function products_category(){
        return view("administrator.products.category");
    }

    public function products_sub_category(){
        $categories = Category::where('display', 'Show')->get(["category as key", "id as value"]);
        return view("administrator.products.sub_category", compact("categories"));
    }

    public function products_product_group(){
        $categories = Category::where('display', 'Show')->get(["category as key", "id as value"]);
        $sub_categories = SubCategory::where('display', 'Show')->get(["sub_category as key", "id as value", "category_id"]);
        return view("administrator.products.product_group", compact("categories", "sub_categories"));
    }

    public function products_products($id){
        $product_group = ProductGroup::find($id);
        return view("administrator.products.products", compact("product_group"));
    }

    public function purchase(){
        return view("administrator.purchase");
    }

    

    public function pending(){
        $o = Order::
        where('orderstatus', 'Success')
        ->where('cancelled_at', null)
        ->where('accepted_at', null)
        ->where('packed_at', null)
        ->where('shipped_at', null)
        ->where('delivered_at', null)
        ->orderBy('id', 'asc');
        $count = $o->count();
        $orders = $o->simplePaginate(1);
        $forward = "Accepted";
        $reverse = null;
        $title = "Pending Orders";
        return view("administrator.orders.order", compact("orders", "title", "count", "forward", "reverse"));
    }

    public function accepted(){
        $o = Order::
        where('orderstatus', 'Success')
        ->where('cancelled_at', null)
        ->where('accepted_at', '!=', null)
        ->where('packed_at', null)
        ->where('shipped_at', null)
        ->where('delivered_at', null)
        ->orderBy('id', 'asc');
        $count = $o->count();
        $orders = $o->simplePaginate(1);
        $forward = "Packed";
        $reverse = "Pending";
        $title = "Accepted Orders";
        return view("administrator.orders.order", compact("orders", "title", "count", "forward", "reverse"));
    }

    public function packed(){
        $o = Order::
        where('orderstatus', 'Success')
        ->where('cancelled_at', null)
        ->where('accepted_at', '!=', null)
        ->where('packed_at', '!=', null)
        ->where('shipped_at', null)
        ->where('delivered_at', null)
        ->orderBy('id', 'asc');
        $count = $o->count();
        $orders = $o->simplePaginate(1);
        $forward = "Shipped";
        $reverse = "Accepted";
        $title = "Packed Orders";
        return view("administrator.orders.order", compact("orders", "title", "count", "forward", "reverse"));
    }

    public function shipped(){
        $o = Order::
        where('orderstatus', 'Success')
        ->where('cancelled_at', null)
        ->where('accepted_at', '!=', null)
        ->where('packed_at', '!=', null)
        ->where('shipped_at', '!=', null)
        ->where('delivered_at', null)
        ->orderBy('id', 'asc');
        $count = $o->count();
        $orders = $o->simplePaginate(1);
        $forward = "Delivered";
        $reverse = "Packed";
        $title = "Shipped Orders";
        return view("administrator.orders.order", compact("orders", "title", "count", "forward", "reverse"));
    }

    public function delivered(){
        $o = Order::
        where('orderstatus', 'Success')
        ->where('cancelled_at', null)
        ->where('accepted_at', '!=', null)
        ->where('packed_at', '!=', null)
        ->where('shipped_at', '!=', null)
        ->where('delivered_at', '!=', null)
        ->orderBy('id', 'asc');
        $count = $o->count();
        $orders = $o->simplePaginate(1);
        $forward = null;
        $reverse = "Shipped";
        $title = "Delivered Orders";
        return view("administrator.orders.order", compact("orders", "title", "count", "forward", "reverse"));
    }

    public function user_manager(){
        return view("administrator.user_manager");
    }

    public function forward($id, $what){
        $timestamp = date('Y-m-d H:i:s');
        $data = [];
        switch($what){
            case "Accepted":
            $data = ["accepted_at" => $timestamp];
            break;

            case "Packed":
            $data = ["packed_at" => $timestamp];
            break;

            case "Shipped":
            $data = ["shipped_at" => $timestamp];
            break;

            case "Delivered":
            $data = ["delivered_at" => $timestamp];
            break;
        }
        $order = Order::find($id);
        $order->update($data);
        return back();
    }

    public function reverse($id, $what){
        switch($what){
            case "Pending":
            $data = ["accepted_at" => null];
            break;

            case "Accepted":
            $data = ["packed_at" => null];
            break;

            case "Packed":
            $data = ["shipped_at" => null];
            break;

            case "Shipped":
            $data = ["delivered_at" => null];
            break;
        }
        $order = Order::find($id);
        $order->update($data);
        return back();
    }

    public function label($id){
        $order = Order::find($id);
        $barcode = DNS1D::getBarcodeHTML($id, 'C39', 2, 30);
        
        $data = [
            "order" => $order,
            "barcode" => $barcode
        ];

        $customPaper = array(0,0,$this->mm2pt(75),$this->mm2pt(100));
        $pdf = Pdf::loadView('common.print.label', $data)->setPaper($customPaper, 'landscape');
        return $pdf->stream('OID-'.$id.'.pdf');
    }

    public function receipt($id){
        $order = Order::find($id);
        $barcode = DNS1D::getBarcodeHTML($id, 'C39', 2, 30);
        
        $data = [
            "order" => $order,
            "barcode" => $barcode
        ];

        $height = (sizeof($order->order_data) * 9) + 120;

        $customPaper = array(0,0,$this->mm2pt(80),$this->mm2pt($height));
        $pdf = Pdf::loadView('common.print.receipt', $data)->setPaper($customPaper, 'portrait');
        return $pdf->stream('OID-'.$id.'.pdf');
    }

    protected function mm2pt($mm){
        return $mm / 25.4 * 72;
    }

    public function offers(){
        return view("administrator.offers");
    }
}
