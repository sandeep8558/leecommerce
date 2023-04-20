<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Charts\CategorySale;
use App\Charts\CustomerRegistration;
use App\Charts\OrderNumbers;
use App\Charts\ProductSale;
use App\Charts\Purchases;
use App\Charts\Sale;
use App\Charts\SubCategorySale;

use App\Models\Category;

class GraphController extends Controller
{

    public function orders(){
        $this->process();
        $on = new OrderNumbers(request()->what, request()->typ, request()->duration, request()->page);
        return view("administrator.analytics.graph", compact("on"));
    }

    public function sale(){
        $this->process();
        $on = new Sale(request()->what, request()->typ, request()->duration, request()->page);
        return view("administrator.analytics.graph", compact("on"));
    }

    public function purchase(){
        $this->process();
        $on = new Purchases(request()->what, request()->typ, request()->duration, request()->page);
        return view("administrator.analytics.graph", compact("on"));
    }

    public function customers(){
        $this->process();
        $on = new CustomerRegistration(request()->what, request()->typ, request()->duration, request()->page);
        return view("administrator.analytics.graph", compact("on"));
    }

    public function category(){
        $this->process();
        $on = new CategorySale(request()->what, request()->typ, request()->duration, request()->page);
        return view("administrator.analytics.graph", compact("on"));
    }

    public function sub_category(){
        $cts = Category::get();
        $this->process();
        $category = isset(request()->category) ? request()->category : 1;
        request()->category = $category;
        $on = new SubCategorySale(request()->what, request()->typ, request()->duration, request()->page, request()->category);
        return view("administrator.analytics.graph", compact("on", "cts"));
    }

    public function product(){
        $this->process();
        $product_id = isset(request()->product_id) ? request()->product_id : 1;
        request()->product_id = $product_id;
        $on = new ProductSale(request()->what, request()->typ, request()->duration, request()->page, request()->product_id);
        return view("administrator.analytics.graph", compact("on", "product_id"));
    }

    public function process(){
        $what = isset(request()->what) ? request()->what : "Day";
        $typ = isset(request()->typ) ? request()->typ : "line";
        $duration = isset(request()->duration) ? request()->duration : 0;
        $page = isset(request()->p) ? request()->p : 1;
        request()->what = $what;
        request()->typ = $typ;
        request()->duration = $duration;
        request()->page = $page;
    }

    //public function order_number(){}

}
