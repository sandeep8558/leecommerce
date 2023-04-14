<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "display",
        "category_id",
        "sub_category_id",
        "product_group_id",
        "mrp",
        "rate",
        "cost",
        "tax",
        "itemcode",
        "barcode",
        "weight",
        "volume",
        "color",
        "size",
        "media_a",
        "media_b",
        "media_c",
        "media_d",
        "media_e",
        "media_f",
    ];

    public function category(){
        return $this->belongsTo("App\Models\Category");
    }

    public function sub_category(){
        return $this->belongsTo("App\Models\SubCategory");
    }

    public function product_group(){
        return $this->belongsTo("App\Models\ProductGroup");
    }

    public function purchases(){
        return $this->hasMany("App\Models\Purchase");
    }

    public function wish_lists(){
        return $this->hasMany("App\Models\WishList");
    }

    protected $appends = ['data_category', 'data_sub_category', 'data_product_group', 'data_qty', 'data_size', 'data_color', 'data_weight', 'data_volume', 'data_wishlist', 'data_cart', 'data_calc'];

    public function getDataCategoryAttribute(){
        return $this->category->category;
    }

    public function getDataSubCategoryAttribute(){
        return $this->sub_category->sub_category;
    }

    public function getDataProductGroupAttribute(){
        return $this->product_group->group_name;
    }

    public function getDataQtyAttribute(){
        $purchase = $this->purchases()->sum('quantity');
        $sale = 0;
        return $purchase - $sale;
    }

    public function getDataSizeAttribute(){
        if($this->size == 'No') { return null; }
        return DB::table('products')
        ->where('product_group_id', $this->product_group_id)
        ->where('color', $this->color)
        ->where('weight', $this->weight)
        ->where('volume', $this->volume)
        ->select('size')
        ->groupBy('size')
        ->get();
    }

    public function getDataColorAttribute(){
        if($this->color == 'No') { return null; }
        return DB::table('products')
        ->where('product_group_id', $this->product_group_id)
        ->where('size', $this->size)
        ->where('weight', $this->weight)
        ->where('volume', $this->volume)
        ->select('color')
        ->groupBy('color')
        ->get();
    }

    public function getDataWeightAttribute(){
        if($this->weight == 'No') { return null; }
        return DB::table('products')
        ->where('product_group_id', $this->product_group_id)
        ->where('size', $this->size)
        ->where('color', $this->color)
        ->where('volume', $this->volume)
        ->select('weight')
        ->groupBy('weight')
        ->get();
    }

    public function getDataVolumeAttribute(){
        if($this->volume == 'No') { return null; }
        return DB::table('products')
        ->where('product_group_id', $this->product_group_id)
        ->where('size', $this->size)
        ->where('color', $this->color)
        ->where('weight', $this->weight)
        ->select('volume')
        ->groupBy('volume')
        ->get();
    }

    public function getDataWishlistAttribute(){
        $w = 0;
        if(Auth::check()){
            if(Auth::user()->wish_lists()->where('product_id', $this->id)->exists()){
                $w = 1;
            }
        }
        return $w;
    }

    public function getDataCartAttribute(){
        $c = 0;
        $cart = session("cart");
        foreach($cart as $i=>$ct){
            if($ct["product_id"] == $this->id){
                $c = $ct["quantity"];
            }
        }
        return $c;
    }

    public function getDataCalcAttribute(){
        $calc = [
            "mrp_total" => $this->mrp * $this->data_cart,
            "rate_total" => $this->rate * $this->data_cart,
            "tax_total" => $this->tax * $this->data_cart,
            "cost_total" => $this->cost * $this->data_cart,
        ];
        return $calc;
    }
}
