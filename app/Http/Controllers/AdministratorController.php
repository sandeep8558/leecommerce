<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductGroup;

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

    public function user_manager(){
        return view("administrator.user_manager");
    }
}
