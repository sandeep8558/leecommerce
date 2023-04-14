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
        return $this->hasMany("App\Models\ProductGroup")->where('display', 'Show');
    }

    public function products(){
        return $this->hasMany("App\Models\Product")->where('display', 'Show');
    }

    protected $appends = ['data_category'];

    public function getDataCategoryAttribute(){
        return $this->category->category;
    }

}
