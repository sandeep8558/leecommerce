<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WishListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = 0;
        if(Auth::check()){$user = Auth::id();}
        $wishlists = Auth::user()->wish_lists()->with('product')->get();
        return view("website.wishlist", compact("wishlists", "user"));
    }

    public function add(Request $request){
        $p = Auth::user()->wish_lists();
        $q = null;
        if($p->where('product_id', $request->product_id)->doesntExist()){
            $q = $p->create($request->all());
        } else {
            $p->where('product_id', $request->product_id)->delete();
        }
        return Auth::user()->wish_lists()->with('product')->get();
    }
}
