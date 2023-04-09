<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $appends = ['data_category', 'data_sub_category', 'data_product_group'];

    public function getDataCategoryAttribute(){
        return $this->category->category;
    }

    public function getDataSubCategoryAttribute(){
        return $this->sub_category->sub_category;
    }

    public function getDataProductGroupAttribute(){
        return $this->product_group->group_name;
    }
}
