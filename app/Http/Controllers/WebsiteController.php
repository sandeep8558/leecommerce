<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Setting;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductGroup;
use Auth;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function __construct()
    {
        
    }

    public function welcome(){
        $welcome_title = $this->getVal("Welcome Title");
        $welcome_note = $this->getVal("Welcome Note");
        $welcome_call = $this->getVal("Welcome Call");

        /* if(session()->has("cart")){
             session("cart");
        } */

        /* session()->forget('abcd');
        session()->forget('fav');
        session()->forget('cart'); */

        /* if(!session()->has("abcd")){
            session(["abcd" => [1,2,3,4]]);
        }

        if(session()->has("abcd")){
            return  session("abcd");
        } */

        if(User::where('email', 'sandeep198558@yahoo.com')->doesntExist()){
            $this->bootstrap();
        }
        $sliders = Slider::where('display', 'Show')->get();
        $features = Feature::where('display', 'Show')->get();

        return view("website.welcome", compact('sliders','features','welcome_title','welcome_note','welcome_call'));
    }

    public function category($id){
        $user = 0;
        if(Auth::check()){$user = Auth::id();}
        $category = Category::find($id);
        $banner = $category->media;
        $products = $category->product_groups()->has('products')->with('products')->simplePaginate();
        $buyqty = Setting::where('key', 'Buy Quantity')->exists() ? Setting::where('key', 'Buy Quantity')->first()->val : null;
        return view("website.category", compact('category','banner','products','user', 'buyqty'));
    }

    public function sub_category($id, $sid){
        $user = 0;
        if(Auth::check()){$user = Auth::id();}
        $category = Category::find($id);
        $sub_category = SubCategory::find($sid);
        $banner = $sub_category->media;
        $products = $sub_category->product_groups()->has('products')->with('products')->simplePaginate();
        $buyqty = Setting::where('key', 'Buy Quantity')->exists() ? Setting::where('key', 'Buy Quantity')->first()->val : null;
        return view("website.category", compact('category','banner','products','user', 'buyqty'));
    }

    public function product($id, $pid){
        $user = 0;
        if(Auth::check()){$user = Auth::id();}
        $product = ProductGroup::with('products')->find($id);
        $buyqty = Setting::where('key', 'Buy Quantity')->exists() ? Setting::where('key', 'Buy Quantity')->first()->val : null;
        return view("website.product", compact('product', 'pid', 'user', 'buyqty'));
    }

    public function bootstrap(){
        $user = User::create([
            "name" => "Sandeep Rathod",
            "mobile" => "9664588677",
            "email" => "sandeep198558@yahoo.com",
            "password" => Hash::make("123456789"),
        ]);

        Role::insert([
            [
                "user_id" => $user->id,
                "role" => "Customer",
                "Status" => "Active"
            ],
            [
                "user_id" => $user->id,
                "role" => "Administrator",
                "Status" => "Active"
            ],
            [
                "user_id" => $user->id,
                "role" => "Web-Admin",
                "Status" => "Active"
            ],
            [
                "user_id" => $user->id,
                "role" => "Store Manager",
                "Status" => "Active"
            ],
        ]);
    }

    public function getVal($key){
        return Setting::where('key', $key)->exists() ? Setting::where('key', $key)->first()->val : null;
    }

}