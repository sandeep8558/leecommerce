<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "display",
        "category_id",
        "sub_category",
        "media",
    ];

    public function category(){
        return $this->belongsTo("App\Models\Category");
    }

    public function product_groups(){
        $this->hasMany("App\Models\ProductGroup");
    }

    public function products(){
        $this->hasMany("App\Models\Product");
    }

    protected $appends = ['data_category'];

    public function getDataCategoryAttribute(){
        return $this->category->category;
    }

}
